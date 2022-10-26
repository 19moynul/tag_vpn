 <nav class="navbar navbar-expand-lg navbar-light">
     <div class="container-fluid">
         <input type="checkbox" id="openCloseSideBar" style="display: none;" />
         <label for="openCloseSideBar">
             <i class="fas fa-bars expand-bar"></i>
         </label>
         <a class="navbar-brand" href="#">TAG VPN</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto pe-4">
                 <li class="nav-item">
                     <span class="mi-action-button">
                         <button type="button" class="butn danger mb-2" data-bs-html="true" title="-----------------------------------------" data-bs-toggle="popover" data-bs-placement="top" style="padding: 0.595rem 0.755rem !important;" data-bs-content="
                            <div class='mi-card'>
                                <div class='mi-header success header-sm'>
                                   <i class='fas fa-user-check info butn-sm'></i> YOU ARE LOGGED IN
                                </div>
                                <div class='mi-body text-uppercase'>
                                    <strong>NAME : IMAM HOSSEN <br>
                                    ROLE : ADMIN</strong>
                                </div>
                                <div class='mi-footer'>
                                    <a href='{{route("logout")}}'' class='butn danger butn-sm transparent w-100'><i class='fas fa-sign-out-alt'></i> LOGOUT</a>
                                </div>
                            </div>">
                             <i class="fa fa-user"></i>
                         </button>
                     </span>
                 </li>
             </ul>
         </div>
     </div>
 </nav>
