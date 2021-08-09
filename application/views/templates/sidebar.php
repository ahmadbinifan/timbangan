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
        <?php if ($this->session->userdata('dap') == 1) { ?>
          <li class="nav-item has-treeview">
            <a href="" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge") {
                                          echo 'active';
                                        } elseif ($this->uri->segment(1) == "weighbridge_out") {
                                          echo 'active';
                                        } ?>">
              <i class=" nav-icon fas fa-industry"></i>
              <p>PT. DAP</p>
            </a>
            <?php if ($this->session->userdata('penerimaan') == 1) { ?>
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview">
                  <a href="<?= base_url('weighbridge') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_priode") {
                                                                              echo 'active';
                                                                            } elseif ($this->uri->segment(1) == "weighbridge") {
                                                                              echo 'active';
                                                                            }
                                                                            ?>">
                    <i class=" fas fa-truck nav-icon-sm"></i>
                    <p>In</p>
                  </a>

                  <?php if ($this->session->userdata('periode') == 1) { ?>
                    <ul class="nav nav-treeview">
                      <li class="nav-item has-treeview">
                        <a href="<?= base_url('weighbridge_priode') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_priode") {
                                                                                          echo 'active';
                                                                                        } ?>
                                                                                  ">
                          <i class="far fa-circle nav-icon "></i>
                          <span>View Priode</span>
                        </a>
                    </ul>
                  <?php } ?>
                  <ul class="nav nav-treeview">
                    <li class="nav-item has-treeview">
                      <a href="<?= base_url('weighbridge') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge") {
                                                                                  echo 'active';
                                                                                } ?>">
                        <i class="far fa-circle nav-icon "></i>
                        <span>View PO</span>
                      </a>
                  </ul>
              </ul>
            <?php } ?>
            <?php if ($this->session->userdata('pengeluaran') == 1) { ?>
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview">
                  <a href="<?= base_url('weighbridge_out') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_priode_out") {
                                                                                  echo 'active';
                                                                                } elseif ($this->uri->segment(1) == "weighbridge_out") {
                                                                                  echo 'active';
                                                                                }
                                                                                ?>">
                    <i class="fas fa-truck-loading nav-icon-sm"></i>
                    <p>Out</p>
                  </a>
                  <?php if ($this->session->userdata('periode') == 1) { ?>
                    <ul class="nav nav-treeview">
                      <li class="nav-item has-treeview">
                        <a href="<?= base_url('weighbridge_priode_out') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_priode_out") {
                                                                                              echo 'active';
                                                                                            } ?> <?php if ($this->session->userdata('id_user') == 2) {
                                                                                                    echo 'disabled';
                                                                                                  } ?> ">
                          <i class="far fa-circle nav-icon "></i>
                          <span>View Priode</span>
                        </a>
                    </ul>
                  <?php } ?>
                  <ul class="nav nav-treeview">
                    <li class="nav-item has-treeview">
                      <a href="<?= base_url('weighbridge_out') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_out") {
                                                                                      echo 'active';
                                                                                    } ?>">
                        <i class="far fa-circle nav-icon "></i>
                        <span>View Contract</span>
                      </a>
                  </ul>
                </li>
              </ul>
            <?php } ?>

            <ul class="nav nav-treeview">
              <?php if ($this->session->userdata('reject') == 1) { ?>
                <li class="nav-item has-treeview">
                  <a href="<?= base_url('reject_ticket') ?>" class="nav-link <?php if ($this->uri->segment(1) == "reject_ticket") {
                                                                                echo 'active';
                                                                              }
                                                                              ?>">
                    <i class="fas fa-times-circle nav-icon-sm"></i>
                    <p>Reject Ticket</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('dsip') == 1) { ?>
          <li class="nav-item has-treeview">
            <a href="" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_dsip") {
                                          echo 'active';
                                        } elseif ($this->uri->segment(1) == "weighbridge_out_dsip") {
                                          echo 'active';
                                        } ?>">
              <i class=" nav-icon fas fa-warehouse"></i>
              <p>PT. DSIP</p>
            </a>
            <?php if ($this->session->userdata('penerimaan') == 1) { ?>
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview">
                  <a href="<?= base_url('weighbridge_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_priode_dsip") {
                                                                                  echo 'active';
                                                                                } elseif ($this->uri->segment(1) == "weighbridge_dsip") {
                                                                                  echo 'active';
                                                                                }
                                                                                ?>">
                    <i class=" fas fa-truck nav-icon-sm"></i>
                    <p>In</p>
                  </a>
                  <?php if ($this->session->userdata('periode') == 1) { ?>
                    <ul class="nav nav-treeview">
                      <li class="nav-item has-treeview">
                        <a href="<?= base_url('weighbridge_priode_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_priode_dsip") {
                                                                                                echo 'active';
                                                                                              } ?> <?php if ($this->session->userdata('id_user') == 2) {
                                                                                                      echo 'disabled';
                                                                                                    } ?>">
                          <i class="far fa-circle nav-icon "></i>
                          <span>View Priode</span>
                        </a>
                    </ul>
                  <?php } ?>
                  <ul class="nav nav-treeview">
                    <li class="nav-item has-treeview">
                      <a href="<?= base_url('weighbridge_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_dsip") {
                                                                                      echo 'active';
                                                                                    } ?>">
                        <i class="far fa-circle nav-icon "></i>
                        <span>View PO</span>
                      </a>
                  </ul>
              </ul>
            <?php } ?>
            <?php if ($this->session->userdata('pengeluaran') == 1) { ?>
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview">
                  <a href="<?= base_url('weighbridge_out_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_priode_dsip_out") {
                                                                                      echo 'active';
                                                                                    } elseif ($this->uri->segment(1) == "weighbridge_out_dsip") {
                                                                                      echo 'active';
                                                                                    }
                                                                                    ?>">
                    <i class=" fas fa-truck-loading nav-icon-sm"></i>
                    <p>Out</p>
                  </a>
                  <?php if ($this->session->userdata('periode') == 1) { ?>
                    <ul class="nav nav-treeview">
                      <li class="nav-item has-treeview">
                        <a href="<?= base_url('weighbridge_priode_dsip_out') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_priode_dsip_out") {
                                                                                                    echo 'active';
                                                                                                  } ?> <?php if ($this->session->userdata('id_user') == 2) {
                                                                                                          echo 'disabled';
                                                                                                        } ?> ">
                          <i class="far fa-circle nav-icon "></i>
                          <span>View Priode</span>
                        </a>
                    </ul>
                  <?php } ?>
                  <ul class="nav nav-treeview">
                    <li class="nav-item has-treeview">
                      <a href="<?= base_url('weighbridge_out_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "weighbridge_out_dsip") {
                                                                                          echo 'active';
                                                                                        } ?>">
                        <i class="far fa-circle nav-icon "></i>
                        <span>View Contract</span>
                      </a>
                  </ul>
                </li>
              </ul>
              <?php if ($this->session->userdata('reject') == 1) { ?>
                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview">
                    <a href="<?= base_url('reject_ticket_dsip') ?>" class="nav-link <?php if ($this->uri->segment(1) == "reject_ticket_dsip") {
                                                                                      echo 'active';
                                                                                    }
                                                                                    ?>">
                      <i class="fas fa-times-circle nav-icon-sm"></i>
                      <p>Reject Ticket</p>
                    </a>
                  </li>
                </ul>
              <?php } ?>
            <?php } ?>
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