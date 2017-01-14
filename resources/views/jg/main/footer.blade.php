<script>
    var getUrl = '{{$getUrl}}';
    var editUrl = '{{$editUrl}}';
    var urlId = '{{ isset($urlId) ? $urlId : 0 }}'; //路由模块节点id
    var roleId = '{{ isset($roleId) ? $roleId : 0 }}'; //角色id

    var nav = $.parseJSON('{!!$nav!!}');
</script>
@foreach ($jsList as $js)
    <script type="text/javascript" src="{{ asset($js)}}"></script>
@endforeach