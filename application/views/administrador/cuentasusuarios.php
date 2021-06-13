<div class="pull-right m-4">

    <button type="button" class="btn btn-primary btn-md " data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus px-2"></i>&nbsp; <?= lang('nuevo') ?> </button>
</div>
<div>
    <table id="usuarios" class="display">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Aciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Row 1 Data 1</td>
                <td>Row 1 Data 2</td>
                <td>Row 1 Data 3</td>
                <td>Row 1 Data 4</td>
            </tr>
            <tr>
                <td>Row 2 Data 1</td>
                <td>Row 2 Data 2</td>
                <td>Row 2 Data 3</td>
                <td>Row 2 Data 4</td>
            </tr>
        </tbody>
    </table>
</div>


<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="largeModalLabel"><?= lang('nuevoUser') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" class="">
                    <div class="row form-group">
                        <div class="col-md-4 input-group">
                            <input type="text" id="iduser" name="iduser" placeholder="<?= lang('idUsuario') ?>" class="form-control">
                        </div>
                        <div class="col-md-4 input-group">
                            <input type="text" id="name" name="name" placeholder="<?= lang('nombreUsuario') ?>" class="form-control">
                        </div>
                        <div class="col-md-4 input-group">
                            <input type="text" id="lastname" name="lastname" placeholder="<?= lang('apellidoUsuario') ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4 input-group">
                            <input type="email" id="email" name="email" placeholder="<?= lang('Email') ?>" class="form-control">
                        </div>
                        <div class="col-md-4 input-group">
                            <input type="text" id="tlf" name="tlf" placeholder="<?= lang('tlf') ?>" class="form-control">
                        </div>
                        <div class="col-md-4 input-group">
                            <input type="text" id="cel" name="cel" placeholder="<?= lang('cel') ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4 input-group">
                            <input type="text" id="username" name="username" placeholder="<?= lang('Username') ?>" class="form-control">
                        </div>
                        <div class="col-md-4 input-group">
                            <input type="password" id="password" name="password" placeholder="<?= lang('Password') ?>" class="form-control">
                        </div>
                        <div class="col-md-4 input-group">                            
                            <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                            <datalist id="datalistOptions">
                                <option value="San Francisco">
                                <option value="New York">
                                <option value="Seattle">
                                <option value="Los Angeles">
                                <option value="Chicago">
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="form-actions form-group text-center">
                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#usuarios').DataTable();
    });
</script>