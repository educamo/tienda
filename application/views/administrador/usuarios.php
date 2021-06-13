<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?= lang('Titulo-Usuarios') ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= base_url('administracion') ?>"><?= lang('Titulo-Administracion') ?></a></li>
                            <li class="active"><?= lang('Titulo-Usuarios') ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="content">
    <script>
        var urlbase = "<?= base_url(); ?>";
    </script>


    <script src="<?= base_url() ?>assets/js/usuarios.js"></script>

    <!-- /# column -->
    <div class="col-lg-12">
        <div class="card">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?Php
                foreach ($subModulos as $key) {
                    if ($key === reset($subModulos)) {
                        $class = 'active';
                    } else {
                        $class = 'hola';
                    }
                    $etiqueta = $key['nombre'];
                ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $class ?>" id="<?= $key['idMod'] . '-tab' ?>" data-toggle="tab" href="#<?= $key['idMod'] ?>" role="tab" aria-controls="<?= $key['idMod'] ?>" aria-selected="true"> <?= lang($etiqueta) ?> </a>
                    </li>
                <?Php
                }
                ?>

            </ul>
            <div class="tab-content pl-3 p-1" id="myTabContent">

                <?Php
                foreach ($subModulos as $valor) {
                    if ($valor === reset($subModulos)) {
                        $class = 'active';
                    } else {
                        $class = '';
                    }
                    $etiqueta = $valor['nombre'];
                ?>
                    <div class="tab-pane fade show <?= $class ?>" id="<?= $valor['idMod'] ?>" role="tabpanel" aria-labelledby="<?= $valor['idMod'] . '-tab' ?>" style="margin-top: 20px;">
                        <h3><?= lang($etiqueta) ?></h3>
                        <div id="contenido<?= $valor['idMod'] ?>" name="contenido<?= $valor['idMod'] ?>" style="height: auto; margin:20px;"> </div>
                    </div>
                    <script>
                        codigo = '<?= $valor['idMod'] ?>';
                        loadUsuarios(codigo);
                    </script>

                <?Php
                }
                ?>

            </div>


        </div>

    </div>


</div><!-- .content -->
<div class="clearfix"></div>