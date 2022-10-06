<input 
    type="text" 
    id="filterInput"
    placeholder="Escreva para filtrar"
    class="form-control"
>
<script>
    $(document).ready(function(){
        $("#filterInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myDateData tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>