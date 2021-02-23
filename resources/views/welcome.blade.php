<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Matrix Multiplication</title>

        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <style>
            :root { --color-blue: #0000ff; --color-blue-hover: #0000dc; --color-grey: #808080; --color-grey-hover: #545454; --color-red: #ff0000; }
            * { box-sizing: border-box; }
            [v-cloak] { display: none; }
            body { font-family: sans-serif; }
            input { padding: 10px; max-width: 100px; }
            button { padding: 10px 20px; background: var(--color-blue); border: none; color: #fff; border-radius: 6px; text-transform: uppercase; outline: none; cursor: pointer; }
            button[type="reset"] { background: var(--color-grey); }
            table { margin-bottom: 20px; display: inline-block; margin-right: 20px; vertical-align: top; }
            td a { display: inline-block; text-decoration: none; background: var(--color-blue); border-radius: 20px; color: #fff; width: 20px; height: 20px; text-align: center; }
            tr td { text-align: center; }
            td a:hover, button:hover { background: var(--color-blue-hover); }
            button[type="reset"]:hover { background: var(--color-grey-hover); }
            button:disabled, input[readonly] { opacity: 0.3; cursor: not-allowed; }
            .error { border: 2px solid var(--color-red); color: var(--color-red); padding: 10px; margin-bottom: 20px; max-width: 500px; }
            .section--result { margin-top: 20px; }
            .section--result td { padding: 10px; background: #eee; }
        </style>
    </head>

    <body>
        <div id="app">
            <h1>Matrix Multiplication</h1>

            <section>
                <table v-for="(matrix, index) in matrices">
                    <thead>
                        <tr>
                            <th :colspan="columnCount(matrix)">Matrix #@{{ index + 1 }} (@{{ columnCount(matrix) }} cols, @{{ rowCount(matrix) }} rows)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(row, rowIndex) in matrix">
                            <td v-for="(col, colIndex) in row">
                                <input type="number" min="0" step="1" v-model.number="matrix[rowIndex][colIndex]" :readonly="resultMatrix" placeholder=0 />
                            </td>
                            <td :rowspan="rowCount(matrix)" v-if="! rowIndex && ! resultMatrix">
                                <a href="#" @click.prevent="addColumn(matrix)" tabindex="-1">+</a>
                            </td>
                        </tr>
                        <tr v-if="! resultMatrix">
                            <td :colspan="columnCount(matrix)">
                                <a href="#" @click.prevent="addRow(matrix)" tabindex="-1">+</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <div class="error" v-if="invalid" v-cloak>
                The column count in the first matrix (@{{ columnCount(matrices[0]) }}) must be equal to the row count (@{{ rowCount(matrices[1]) }}) of the second matrix.
            </div>

            <button type="submit" @click="submit()" :disabled="invalid">Multiply</button>
            <button type="reset" @click="reset()">Reset</button>

            <section class="section--result" v-if="resultMatrix">
                <table>
                    <thead>
                        <tr>
                            <th :colspan="columnCount(resultMatrix)">Result Matrix</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(row, rowIndex) in resultMatrix">
                            <td v-for="(col, colIndex) in row">@{{ resultMatrix[rowIndex][colIndex] }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>

        <script>
        var app = new Vue({
            el: '#app',

            data: {
                matrices: [],
                resultMatrix: null,
            },

            created() {
                this.reset();
            },

            computed: {
                invalid() {
                    // the column count in the first matrix must be equal to the row count of the second matrix
                    return this.columnCount(this.matrices[0]) !== this.rowCount(this.matrices[1]);
                }
            },

            methods: {
                addColumn(matrix) {
                    matrix.forEach(row => {
                        row.push(null);
                    });
                },

                addRow(matrix) {
                    matrix.push(new Array(this.columnCount(matrix)));
                },

                rowCount(matrix) {
                    return matrix.length;
                },

                columnCount(matrix) {
                    return matrix[0].length;
                },

                submit() {
                    // using a POST request (instead of GET) to avoid param serialization
                    axios.post('/api/multiply', {
                        matrix1: this.matrices[0],
                        matrix2: this.matrices[1]
                    }).then(response => {
                        this.resultMatrix = response.data.data;
                    })
                    .catch(error => {
                        alert(error.response.data.message);
                    });
                },

                reset() {
                    // reset the result matrix
                    this.resultMatrix = null;

                    // set the two default matrices (2x2)
                    this.matrices = [
                        [new Array(2), new Array(2)],
                        [new Array(2), new Array(2)]
                    ];
                },
            }
        });
        </script>
    </body>
</html>