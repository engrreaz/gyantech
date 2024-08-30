<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="<?php echo $pth;?>" style="max-width:32px; max-height:32px;"
            alt="User Image" />
        <div>
            <p class="app-sidebar__user-name"><?php echo $fullname;?></p>
            <p class="app-sidebar__user-designation"><?php echo $userlevel;?></p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span
                    class="app-menu__label">Dashboard</span></a>
        </li>
        <li>
            <a class="app-menu__item" href="curaff.php"><i class="app-menu__icon fa fa-university"></i><span
                    class="app-menu__label">Current Affairs</span></a>
        </li>
        <li hidden>
            <a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-dashboard"></i><span
                    class="app-menu__label">Leaderboard</span></a>
        </li>
        <li hidden>
            <a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-dashboard"></i><span
                    class="app-menu__label">Acheievement</span></a>
        </li>
       
        <li class="treeview" hidden>
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                    class="app-menu__label">My Record Room</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>
                        My Tests</a>
                </li> 
                <li>
                    <a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>
                        New Test</a>
                </li> 
                <li>
                    <a class="treeview-item" href="#"><i class="icon fa fa-circle-o"></i>
                       My Submission</a>
                </li> 
                <li>
                    <a class="treeview-item" href="queeditor.php"><i class="icon fa fa-circle"></i>
                       Quetions Editor</a>
                </li> 
            </ul>
        </li>



        <!-- ********************************************************************* -->
<?php if($userlevel == 'Editor' || $userlevel == 'Administrator' || $userlevel == 'Super Administrator' ) { ?>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                    class="app-menu__label">Administration</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="category.php"><i class="icon fa fa-circle-o"></i>
                        Category/Sub Category</a>
                </li> 
                <li>
                    <a class="treeview-item" href="gyanbank.php"><i class="icon fa fa-circle-o"></i>
                       Knowledge Base</a>
                </li> 
                <li>
                    <a class="treeview-item" href="affairsbank.php"><i class="icon fa fa-university"></i>
                       Affairs Bank</a>
                </li> 
                <li hidden>
                    <a class="treeview-item" href="quebank.php"><i class="icon fa fa-circle-o"></i>
                       Quetions Bank</a>
                </li> 
                <li hidden>
                    <a class="treeview-item" href="queeditor.php"><i class="icon fa fa-circle-o"></i>
                       Quetions Editor</a>
                </li> 
            </ul>
        </li>
  
<?php } ?>


    </ul>
</aside>