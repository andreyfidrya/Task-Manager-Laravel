<script language=javascript>
    function previewFile(input){
        var preview = document.querySelector('#img-cl');
        var file = input.files[0];
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
    <x-form-input name="name" label="Name"/> 
</div> 
<div class="mb-3">    
    <x-form-input name="slug" label="Slug"/> 
</div>
<div class="mb-3">
    <x-form-textarea name="info" id="editor" label="Info"/>
</div>
<div class="mb-3">    
    <x-form-input name="price" label="Price"/> 
</div>
<div class="mb-3">        
    <x-form-input name="image" type="file" label="Image" onchange="previewFile(this)"/>
    <img style="max-width:150px;margin-top:20px;" id="img-cl"/>      
</div>

<script>
    $(function(){            

        $("input[name='name']").on("change",function(){
            $("input[name='slug']").val(StringToSlug($(this).val())); 
        });

    });

    function StringToSlug(Text)
    {
        return Text.toLowerCase()
        .replace(/[^\w ]+/g,"")
        .replace(/ +/g,"-");
    }
</script>
