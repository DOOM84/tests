<script>
    function printData() {
        var divToPrint = document.getElementById("res");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
    function mailData() {
        var divToPrint = document.getElementById("res");
        $.ajax({
            type: "POST",
            url: '{{route('user.sendTable')}}',
            data: {
                "_token": '{{ csrf_token() }}',
                "table": divToPrint.outerHTML,
            },
            success: function (data) {
                //$("#container").html(filtered);
                var mes = document.getElementById('ratemes');
                mes.style.display = 'block';
                mes.innerHTML = '{{__('page.sentMail')}}';
            }
        });
    }
</script>