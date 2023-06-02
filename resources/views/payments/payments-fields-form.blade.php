@csrf
  <div class="mb-3">
    <x-controls.input name="payment" label="Payment Name" :item="$payment ?? null"/>
  </div>
  <div class="mb-3">
    <x-controls.input name="amount" label="Amount" :item="$payment ?? null"/>
  </div> 
  <div class="mb-3">
    <x-controls.input type="date" name="duedate" label="Due date" :item="$payment ?? null"/>
  </div>
  <div class="mb-3">
    <x-controls.input name="daysleft" label="Daysleft" :item="$payment ?? null"/>
  </div>
  
  