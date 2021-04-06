<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-success elevation-4">
  <a href="" class="brand-link bg-success">
    <img src="<?= base_url('assets/'); ?>dist/img/default/logon.png"" alt=" Logo Bakrie" class="brand-image img-circle elevation-2 bg-white" style="opacity: .8">
    <span class="brand-text font-weight-white" style="font-size: 11pt; color:white;">Bakrie Renewable Chemicals</span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url('assets/'); ?>dist/img/default/admin.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a class="d-block"><?= $this->session->userdata('fullname'); ?></a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="<?= base_url('home') ?>" class="nav-link <?php if ($this->uri->segment(1) == "home") {
                                                              echo 'active';
                                                            } ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-header">Wighbridge Data</li>
        <li class="nav-item has-treeview">
          <a href="" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge") {
                                        echo 'active';
                                      } elseif ($this->uri->segment(1) == "weighbridge_out") {
                                        echo 'active';
                                      } ?>">
            <i class=" nav-icon fas fa-industry"></i>
            <p>PT. DAP</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('weighbridge') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge") {
                                                                          echo 'active';
                                                                        } ?>"">
                <i class=" fas fa-truck nav-icon"></i>
                <p>In</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('weighbridge_out') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_out") {
                                                                              echo 'active';
                                                                            } ?>"">
                <i class=" fas fa-truck-loading nav-icon"></i>
                <p>Out</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_dsip") {
                                        echo 'active';
                                      } elseif ($this->uri->segment(1) == "weighbridge_out_dsip") {
                                        echo 'active';
                                      } ?>">
            <i class=" nav-icon fas fa-warehouse"></i>
            <p>PT. DSIP</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('weighbridge_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_dsip") {
                                                                              echo 'active';
                                                                            } ?>"">
                <i class=" fas fa-truck nav-icon sm"></i>
                <p>In</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('weighbridge_out_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_out_dsip") {
                                                                                  echo 'active';
                                                                                } ?>"">
                <i class=" fas fa-truck-loading nav-icon"></i>
                <p>Out</p>
              </a>
            </li>
          </ul>
        </li>
        <?php if ($this->session->userdata('username') == "superuser") { ?>
          <li class="nav-header">Report</li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url('report') ?>" class="nav-link <?php if ($this->uri->segment(1) == "report") {
                                                                  echo 'active';
                                                                } elseif ($this->uri->segment(1) == "report_out") {
                                                                  echo 'active';
                                                                } ?>">
              <i class="nav-icon fas fa-industry"></i>
              <p>PT. DAP</p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('report') ?>" class="nav-link <?php if ($this->uri->segment(1) == "report") {
                                                                      echo 'active';
                                                                    } ?>"">
                <i class=" fas fa-file-invoice nav-icon sm"></i>
                  <p>In</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('report_out') ?>" class="nav-link <?php if ($this->uri->segment(1) == "report_out") {
                                                                          echo 'active';
                                                                        } ?>"">
                <i class=" fas fa-file-alt nav-icon"></i>
                  <p>Out</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url('report_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "report_dsip") {
                                                                        echo 'active';
                                                                      } elseif ($this->uri->segment(1) == "report_out_dsip") {
                                                                        echo 'active';
                                                                      } ?>">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>PT. DSIP</p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('report_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "report_dsip") {
                                                                            echo 'active';
                                                                          } ?>"">
                <i class=" fas fa-file-invoice nav-icon sm"></i>
                  <p>In</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('report_out_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "report_out_dsip") {
                                                                                echo 'active';
                                                                              } ?>"">
                <i class=" fas fa-file-alt nav-icon"></i>
                  <p>Out</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('username') == "superuser") { ?>
          <li class="nav-header">Management User</li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url('user') ?>" class="nav-link <?php if ($this->uri->segment(1) == "user") {
                                                                echo 'active';
                                                              } ?>">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>User</p>
            </a>
          </li>
        <?php } ?>
      </ul>
    </nav>
  </div>
</aside>