@csrf
<div class="mb-3">    
    <x-form-input name="name" label="Name"/> 
</div>
<div class="mb-3">    
    <x-form-input name="slug" label="Slug"/> 
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