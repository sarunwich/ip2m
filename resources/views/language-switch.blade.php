<form action="{{route('language.switch')}}" method="POST" class="inline-block">
    @csrf
    <select class="form-control changeLang" name="language" onchange="this.form.submit()" class="p-2 rounded ng-gray-100 text-rray-800">
        <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
        <option value="th" {{ app()->getLocale() ==='th' ? 'selected' : '' }}>ไทย</option>
        
    </select>
</form>