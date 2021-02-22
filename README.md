# Matrix Multiplication

A simple backend application that allows to multiply two matrices. The frontend is a simple Vue.js application with basic CSS.
The resulting matrix will output alphabetical representations of the results, similar to Excel file headers (1=A, 26=Z, 27=AA).

## Features

- PHP 7.4
- Laravel + Vue.js
- PSR-12
- Strict type hinting
- Unit tests

## Assumptions

- Vue.js 2.x (no composition API)
- no use of external libraries (for matrix calculations etc.)
- no use of external css preprocessors (scss), compilers (ES6) or frameworks (e.g. tailwind)
- therefore, direct cdn usage for vue and axios (no use of npm) and no use of components or seperate css/js files in frontend
- without taking any additional/custom coding styles into account with regards to:
  - bracket indentation in control structures
  - Vue.js specific coding style (trailing semicolon, etc.)
  - html/vue attributes on new lines (or not)

## Author

Frank Michel, [FMDSC](https://www.fmdsc.net)