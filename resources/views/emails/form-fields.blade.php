@csrf
<div class="mb-3">    
    <x-form-input name="spam" label="Spam"/> 
</div>
<div class="mb-3">    
    <x-form-input name="client" label="Client"/> 
</div>
<div class="mb-3">
    <x-form-textarea name="intro" id="editor" label="Intro"/>
</div>
<div class="mb-3">
    <x-form-textarea name="samples" label="Samples"/>
</div>
<div class="mb-3">
    <x-form-select name="topics" label="Topics" :options="['Topic 1' => 'Topic 1', 'Topic 2' => 'Topic 2']" placeholder="Select a topic"/> 
</div>
<div class="mb-3">
    <x-form-select name="wordpress" label="WordPress" :options="['Yes' => 'Yes', 'No' => 'No']" placeholder="Does the job require WordPress skills?"/> 
</div>
<div class="mb-3">
    <x-form-select name="seo" label="SEO" :options="['Yes' => 'Yes', 'No' => 'No']" placeholder="Does the job require SEO skills?"/> 
</div>
<div class="mb-3">
    <x-form-textarea name="conclusion" id="editor2" label="Conclusion"/>
</div>


