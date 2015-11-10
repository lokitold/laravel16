@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Noticias</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-10">
            <div class="container">
                <?php foreach ($noticias as $noticia): ?>
                    <?php echo '<br>'.$noticia->url; ?>
                <?php endforeach; ?>
            </div>
            <?php echo $noticias->render(); ?>
        </div>
    </div>
@endsection

