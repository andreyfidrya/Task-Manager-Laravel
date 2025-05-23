<script language=javascript>
    function previewFile(){
        var preview = document.querySelector('#img-ae');
        var file  = document.querySelector('input[type=file]').files [0];
        var reader = new FileReader();
        reader.onloadend = function () {
        preview.src = reader.result;
        }
        if (file) {
        reader.readAsDataURL(file);
        } else {
        preview.src = "";
        }
    }
</script>
@csrf
<div class="mb-3">    
    <x-form-input name="month" label="Month"/> 
</div>
<div class="mb-3">    
    <x-form-input name="andrey" label="Andrey's monthly earnings"/> 
</div>
<div class="mb-3">    
    <x-form-input name="elena" label="Elena's monthly earnings"/> 
</div>
<div class="mb-3">    
    <x-form-input name="amount" label="Amount"/> 
</div>
<div class="mb-3">        
    <x-form-input name="image" type="file" label="Image" onchange="previewFile()"/>
    <img style="max-width:150px;margin-top:20px;" id="img-ae"/>     
</div>



