    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script>
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });
        $(document).ready(function() {
            console.log( "ready!" );
            $('#p_doctor').on('change', function() {
                var docFee = ""+(this.value);
                var ArrDocFee = docFee.split("|");
                $("#p_fee").val(Math.trunc(ArrDocFee[2]));
                //Old new Patient
                if(ArrDocFee[0]==1){
                    $("#new-old-pat").show();
                    $("#old-pat").prop("checked", true);
                }
                else{
                    $("#new-old-pat").hide();
                }
            });

            $('input[type=radio][name=new-old-pat]').change(function() {
                if (this.value == 'new-pat') {
                    var oldFee = $("#p_fee").val()*1;
                    $("#p_fee").val(Math.trunc(oldFee+400));
                }
                else{
                    var oldFee = $("#p_fee").val()*1;
                    $("#p_fee").val(Math.trunc(oldFee-400));
                }
            });
        });
    </script>
</body>
</html>