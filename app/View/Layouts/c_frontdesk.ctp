<?php
/**
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link          http://cakephp.org CakePHP(tm) Project
* @package       app.View.Layouts
* @since         CakePHP(tm) v 0.10.0.1076
* @license       http://www.opensource.org/licenses/mit-license.php MIT License
*/

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>

            <?php echo $this->fetch('title'); ?>
        </title>
        <?php
        echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0',  'http-equiv' => "X-UA-Compatible"));
        echo $this->Html->meta('icon');

        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('font-awesome.min');
        echo $this->Html->css('ionicons.min');
        echo $this->Html->css('AdminLTE');
        echo $this->Html->css('timepicker/bootstrap-timepicker.min');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body class="skin-red">

        <header class="header">
            <a href="" class="logo">

                <?php echo $this->fetch('store'); ?>
            </a>

            <nav class="navbar navbar-static-top" role="navigation">

                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $data['username'];?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">

                                <li class="user-header bg-red">
                                    <?php echo $this->fetch('user'); ?>

                                </li>

                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <?php echo $this->Html->link(
                                        'Sign out',
                                        array('controller' => 'pages',
                                        'action' => 'logout',
                                        'full_base' => true

                                        ),
                                        array('escape'=>false, 'class' => 'btn btn-default btn-flat')
                                        );?>

                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">

            <aside class="left-side sidebar-offcanvas">

                <section class="sidebar">

                    <?php echo $this->fetch('sidebar'); ?>
                </section>
            </aside>


            <aside class="right-side">

                <?php echo $this->fetch('content'); ?>

            </aside>

        </div>


        <?php
        echo $this->Html->script('jquery');
        echo $this->Html->script('jquery-ui-1.10.3.min');
        echo $this->Html->script('bootstrap.min');
        echo $this->Html->script('AdminLTE/app');
        echo $this->fetch('additional');
        ?>
    </body>

</html>
