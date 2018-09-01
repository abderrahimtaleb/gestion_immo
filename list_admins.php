<?php         
   include('connexion.class.php');
   include('admins.class.php');

         $bdd = new Db_connect();
         $admin=new Admin($bdd->connect());

         $list_admins=$admin->getAdmins();
         foreach ($list_admins as $admin) {

            # code...
         
                  echo '<tr class="gradeX">

                                       <td>'.$admin['id_admin'].'</td>
                                       
                                       <td>'.$admin['nom'].' '.$admin['prenom'].'</td>

                                       <td class="center">'.$admin['email'].'</td>
                                       <td class="center">'.$admin['login'].'</td>
                                       <td class="">
                                          <button id="'.$admin['id_admin'].'" class="btn btn-danger btn-sm delbtn" data-toggle="modal" data-target="#modaldel"><i class="fa fa-trash"></i> supprimer </button>
                                          

                                       </td>
                     </tr>';

                  }
                     ?>