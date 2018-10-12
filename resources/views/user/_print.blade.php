<script>
    function printData() {
        var divToPrint = document.getElementById("res");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        console.log(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
</script>