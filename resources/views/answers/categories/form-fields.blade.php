@csrf
<div class="mb-3">    
    <x-form-input name="name" label="Name"/> 
</div>
<div class="mb-3">    
    <x-form-input name="slug" label="Slug"/> 
</div>
<div class="mb-3">    
    <x-form-input name="priority" label="Priority"/> 
</div>

<div class="mb-3">
    <input type="hidden" name="beforemaintext" value="0"> 
    
    <label>
        <input 
            type="checkbox" 
            name="beforemaintext" 
            value="1"
            {{ old('beforemaintext', $category->beforemaintext ?? 0) ? 'checked' : '' }}
        >
        Before main text
    </label>
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

