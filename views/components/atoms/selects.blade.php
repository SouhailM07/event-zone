@props(["selects","selected"=>"All","class"=>""])
<select  @class(["block w-full rounded-md px-3 py-2.5  text-heading text-sm  focus:ring-brand focus:border-brand  placeholder:text-body", $class])>
    <option selected>{{$selected}}</option>
    @foreach($selects as $select)
    <option :value="$select['value']">{{$select['label']}}</option>
    @endforeach
  </select>