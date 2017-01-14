<script>
    var getUrl = '{{$getUrl}}';
    var editUrl = '{{$editUrl}}';
    var urlId = '{{ isset($urlId) ? $urlId : 0 }}'; //路由模块节点id
</script>
@foreach ($jsList as $js)
    <script type="text/javascript" src="{{ asset($js)}}"></script>
@endforeach