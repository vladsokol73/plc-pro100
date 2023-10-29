@props([
    "type" => "text",
    "value" => "",
    "isError" => false
])

<input type="{{ $type }}" value="{{ $value }}" {{ $attributes
 ->class([
     "_is-error" => $isError
     ])
 }}>
