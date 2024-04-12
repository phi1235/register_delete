<form method="POST" action="/htmll">
    <div>
        <input type="text" name="username" placeholder="Nhap ten...">
        <input type="hidden" name="_token" value="<?php  echo csrf_token();?>">
    </div>
    <button type="submit">Submit</button>
</form>