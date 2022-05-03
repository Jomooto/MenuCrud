<?php 
    use models\menu; 
?>
<div class="card mt-5">
    <div class="card-body">
        <a class="btn btn-primary mb-4" href="?controller=menus&action=crear" type="submit">Nuevo</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Menu Padre</th>
                    <th>Acction</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menus as $menu) { ?>
                    <tr>
                        <td><?= $menu->id ?></td>
                        <td><?= $menu->name ?></td>
                        <td><?= $menu->description ?></td>
                        <td hidden><?= $menu->father_id ?></td>
                        <td><?= $menu->name2 ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="">
                                <?php if(!(menu::ifHaveSon($menu->id))) { ?>
                                    <a href="?controller=menus&action=borrar&id=<?= $menu->id ?>" class="btn btn-danger">Borrar</a>
                                <?php } ?>
                                &nbsp&nbsp
                                <a href="?controller=menus&action=editar&id=<?= $menu->id ?> " class="btn btn-warning">Editar</a>

                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>