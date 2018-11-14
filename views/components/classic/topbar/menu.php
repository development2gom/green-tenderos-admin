<?php

use yii\helpers\Url;

?>
<div class="site-menubar site-menubar-light">
  <div class="site-menubar-body">
    <div>
      <div>
        <ul class="site-menu" data-plugin="menu">
          <li class="site-menu-category">General</li>
          <li class="dropdown site-menu-item has-sub">
            <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
              <i class="site-menu-icon wb-upload" aria-hidden="true"></i>
              <span class="site-menu-title">Reportes</span>
              <span class="site-menu-arrow"></span>
            </a>
            <div class="dropdown-menu">
              <div class="site-menu-scroll-wrap is-list">
                <div>
                  <div>
                    <ul class="site-menu-sub site-menu-normal-list">
                      <li class="site-menu-item">
                        <a class="animsition-link" href="<?=Url::base()?>/site/importar-data">
                          <span class="site-menu-title">Cargar data</span>
                        </a>
                      </li>
                     
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </li>

           <li class="dropdown site-menu-item has-sub">
            <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
              <i class="site-menu-icon wb-flag" aria-hidden="true"></i>
              <span class="site-menu-title">Testimonios</span>
              <span class="site-menu-arrow"></span>
            </a>
            <div class="dropdown-menu">
              <div class="site-menu-scroll-wrap is-list">
                <div>
                  <div>
                    <ul class="site-menu-sub site-menu-normal-list">
                      <li class="site-menu-item">
                        <a class="animsition-link" href="<?=Url::base()?>/imagenes">
                          <span class="site-menu-title">Fotos</span>
                        </a>
                      </li>
                      <li class="site-menu-item">
                        <a class="animsition-link" href="<?=Url::base()?>/videos">
                          <span class="site-menu-title">Videos</span>
                        </a>
                      </li>
                      
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </li>
          
        </ul>
      </div>
    </div>
  </div>
</div>