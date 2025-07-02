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
    <x-form-select name="month" :options="$months" label="Month" placeholder="Select the month"/> 
</div>
<div class="mb-3">    
    <x-form-input id="input1" name="earnings_source" label="Earnings Source"/> 
</div>
<div class="mb-3">    
    <x-form-input id="result" name="amount" label="Amount" onclick="sumInputs()"/> 
</div>
<div class="mb-3">        
    <x-form-input name="image" type="file" label="Image" onchange="previewFile()"/>
    <img style="max-width:150px;margin-top:20px;" id="img-ae"/>     
</div>

<script>
    function sumInputs() {
      const val1 = parseFloat(document.getElementById('input1').value) || 0;
      const val2 = parseFloat(document.getElementById('input2').value) || 0;
      const sum = val1 + val2;
      document.getElementById('result').value = sum;
    }
</script>



