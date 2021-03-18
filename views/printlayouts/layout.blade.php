<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Print Layout {!! ' - '.setting('site_name') !!}</title>
    {!! get_style_tags() !!}
    <style>
        body {
            background-color: #FFF;
            color: #000;
        }
    </style>
    {!! $model->style !!}
    <script>
        window.print();
    </script>
</head>
<body>
@foreach($orders as $ix=>$order)
    {!! $order !!}
    @if($ix != count($orders) - 1 )
        @if($model->separate_pages)
            <br style="page-break-after: always"/>
        @else
            {!! $model->page_separator !!}
        @endif
    @endif
@endforeach
</body>
</html>
