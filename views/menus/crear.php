<div class="card">
    <div class="card-header">
        Agregar Menu
    <div class="card-body">
        <form action="" method="post" id="menuform">
            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text"
                class="form-control" required name="name" id="name" aria-describedby="helpId"  placeholder="Nombre" required>
            </div>
            <div class="form-group">
                <label for="">Menu Padre</label>
                <select class="col-12" name="father_id" class="form-control">
                    <option value=""  id="NULL"></option>
                    <?php
                        if($menus){
                            foreach ($menus as $menu) {
                        
                            ?>
                            <option value="<?= $menu->id ?>">
                            <?= $menu->name ?>
                            </option>                    
                    <?php } } ?>
                </select>
                <div class="form-group">
                <label for="">Descripcion</label>
                <textarea type="text" required class="form-control" rows="5" name="description" id="description" placeholder="Escriba la descripcion aqui"></textarea>
            </div>
            <button name="btn-crear" id="btn-crear" class="btn btn-success" type="submit">Agregar Menu</button>
            <a href="?controller=menu&action=inicio" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
</div>


<script src="../../js/crear.js"></script>