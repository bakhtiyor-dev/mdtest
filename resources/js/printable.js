/*
Usage:
attach printable function to event (onclick='printable(id)')
and give the id of block you want to print
 */

window.printable = (id) => {
    let printContents = document.getElementById(id).innerHTML;
    printHTML(printContents);
}

window.printHTML = (printContents) => {
    let originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

