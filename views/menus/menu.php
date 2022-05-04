<?php
    include_once('./models/menu.php');
    use models\menu;
?>
<div class="container mx-auto mt-5">
    <nav class="navbar navbar-expand-lg navbar-nav navbar-light bg-light">
        <a class="navbar-brand" href="?controller=menu&action=inicio">Home</a>        
        
        <?php
            
            $menus = menu::nullMenus();
            // recursivo($menus);
            // function recursivo($menus){
                        foreach ($menus as $menu){
                            echo ("<div class='collapse navbar-collapse'>
                            <ul class='navbar-nav'>            
                            <li class='nav-item dropdown'>");
                        // aqui van los menus cabecera
                                $submenus = menu::subMenus($menu->id);
                            // var_dump((bool)$submenus);
                            if(!$submenus){
                            echo ("<a class='nav-link dropdown-toggle' href='?controller=menus&action=general&menu=". $menu->name . "' id='".$menu->id."'>".
                            
                                $menu->name.
                            "</a>");
                            }else{
                                echo ("<a class='nav-link dropdown-toggle dropdown-toggle-split' href='?controller=menus&action=general&menu=". $menu->name . "' data-toggle='dropdown'>".
                                
                                    $menu->name.
                                "</a>");
                            }
                            echo ("<div class='dropdown-menu'>");                    
                        
                            submenus($menu);
                            echo ("</div>");                 
                            echo("</li> </ul> </div>");
                    }
                    

                function submenus($menu){
                    
                    $submenus = menu::subMenus($menu->id);
                    // var_dump((bool)$submenus);
                    if($submenus){
                        
                        
                        foreach ($submenus as $submenu){  
                            
                            $submenus = menu::subMenus($menu->id);
                            // var_dump((bool)$submenus);
                            if(!$submenus){
                            // echo ("<a class='nav-link dropdown-item'  id='".$menu->id."' href='?controller=menus&action=general&menu=". $menu->name . "' id='".$menu->id."' data-toggle='dropdown'>".($submenu->name)."</a>");
                            echo ("<a class='nav-link dropdown-toggle' href='?controller=menus&action=general&menu=". $menu->name . "' id='".$menu->id."'>".
                            $submenu->name.
                                "</a>");
                            }else{
                                // echo ("<a class='nav-link dropdown-item'  href='?controller=menus&action=general&menu=". $menu->name . "' id='".$menu->id."' data-toggle='dropdown'>".($submenu->name)."</a>");
                                echo ("<a class='nav-link dropdown-toggle' href='?controller=menus&action=general&menu=". $menu->name . "' id='".$menu->id."'>".
                                $submenu->name.
                                "</a>");
                            }

                            // echo 'hijo =>'. ($submenu->id) . '<br>';
                            if(menu::checkSubMenus($submenu->id)){
                                // var_dump($submenu->id);
                                // echo 'falta un menu aqui';
                                submenus($submenu);
                            }
                        }
                        
                    }
                }
                // submenus($menu);
            
                
            
            // }
        ?>       
    </nav>
</div>