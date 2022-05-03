<div class="card">
    <div class="card-header">
        Agregar Menu
    <div class="card-body">

    <form action="" method="post" id="menuform">
            <div class="form-group">
                <input type="text" value="<?= $menu->id ?>" name="id" id="id" hidden>
                <label for="">Nombre</label>
                <input type="text"
                class="form-control" value="<?= $menu->name?>" required name="name" id="name" aria-describedby="helpId"  placeholder="Nombre" required>
            </div>
            <div class="form-group">
                <label for="">Menu Padre</label>
                <select class="col-12" name="father_id" class="form-control">               
                            <option value="<?php echo $menu->id ?>">
                            <?php echo $menu->name2 ?>
                            </option>
                            <?php
                                if($existentes){
                                    foreach ($existentes as $existente) {
                                
                                    ?>
                                    <option value="<?= $existente->id ?>">
                                    <?= $existente->name ?>
                                    </option>                    
                            <?php } } ?>                  
                </select>
                <div class="form-group">
                <label for="">Descripcion</label>
                <textarea type="text"  required class="form-control" rows="5" name="description" id="description">
                    <?php echo $menu->description ?>
                </textarea>
            </div>
            <button name="btn-crear" id="btn-crear" class="btn btn-success" type="submit">Actualizar Menu</button>
            <a href="?controller=menu&action=inicio" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
</div>

<!-- <script src="../../js/crear.js"></script> -->