@extends('layouts.master')

@section('title','LRI | Liste des Partenaires')

@section('header_page')
	<h1>
        Partenaire<small>Liste</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Partenaires</li>
      </ol>
@endsection

@section('asidebar')

		<li >
          <a href="{{url('dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
            <a href="{{url('actualites')}}">
                <i class="fa fa-newspaper-o"></i> <span>Actualites</span>
            </a>
          </li>
         <li >
          <a href="{{url('equipes')}}">
            <i class="fa fa-group"></i> 
            <span>Equipes</span>
          </a>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Membres</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('trombinoscope')}}"><i class="fa fa-id-badge"></i> Trombinoscope</a></li>
            <li><a href="{{url('membres')}}"><i class="fa fa-list"></i> Liste</a></li>
          </ul>
        </li>
        <li class="active">
            <a href="{{url('partenaires')}}">
              <i class="fa fa-group"></i> 
              <span>Partenaires</span>
            </a>
          </li>
          <li >
              <a href="{{url('contacts')}}">
                <i class="fa fa-list"></i> 
                <span>Contacts</span>
              </a>
            </li>
            <li>
                <a href="{{url('stages')}}">
                  <i class="fa fa-file-pdf-o"></i> 
                  <span>Stages</span>
                </a>
              </li>
        <li>
          <a href="{{url('theses')}}">
            <i class="fa fa-file-pdf-o"></i> 
            <span>Thèses</span>
          </a>
        </li>


        <li>
          <a href="{{url('articles')}}">
            <i class="fa fa-newspaper-o"></i> 
            <span>Articles</span></a>
        </li>

       
        <li>
          <a href="{{url('projets')}}">
            <i class="fa fa-folder-open-o"></i> 
            <span>Projets</span>
          </a>
        </li>
        @if(Auth::user()->role->nom == 'admin' )
        <li>
          <a href="{{url('materiels')}}">
            <i class="glyphicon glyphicon-blackboard"></i> 
            <span>Materiels</span>
          </a>
        </li>
        @endif

         
          @if(Auth::user()->role->nom == 'admin' )

          <li>
          <a href="{{url('parametre')}}">
            <i class="fa fa-gears"></i> 
            <span>Paramètres</span></a>
          </li>
          @endif


@endsection

@section('content')


  <div class="row">
      <div class="col-xs-12">
        <div class="box col-xs-12">
          <div class="container" style="padding-top: 30px">
          <div class="row">
            <div class="box-header col-xs-11">
              <legend><center><h2><b>PARTENAIRES</b></h2></center></legend>
            </div>
            
          </div>
          </div>
            
            <!-- /.box-header -->
          <div class="box-body">

            
            <div class=" pull-right" style="padding-bottom: 20px">
                <a href="{{url('partenaires/create')}}" type="button" class="btn btn-block btn-success btn-lg"><i class="fa fa-plus"></i> <i class="fa fa-group"></i> Nouveau Partenaire</a>
            </div>
            

            <div class="row" >
              <div class="col-xs-12">
              @foreach($partenaires as $partenaire)
              

                <div class="col-xs-6">
                  <div class="box box-widget widget-user">
                    <div class="box-tools pull-right">
                      @if(Auth::user()->role->nom == 'admin' )

                 <!--      <form action="{{ url('partenaires/'.$partenaire->id)}}" method="post">
                          
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                      <button type="submit" class="btn btn-box-tool"><i class="fa fa-times"></i>
                      </button>
                      </form> -->


                      <a href="#supprimer{{ $partenaire->id }}Modal"  data-id="{{ $partenaire->id }}" role="button" class="btn btn-box-tool btn_supp_par" data-toggle="modal"><i class="fa fa-times"></i></a>
                      <div class="modal fade bd-example-modal-lg" id="supprimer{{ $partenaire->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="supprimer{{ $partenaire->id }}ModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                    <!--   <h5 class="modal-title" id="supprimer{{ $partenaire->id }}ModalLabel">Supprimer</h5> -->
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body text-center">
                                      Voulez-vous vraiment effectuer la suppression ? 
                                       cela entrenera la suppression des contacts et des stages concernes par ce partenaire 
                                  </div>
                                 
                                     
                                
             <div class="modal-body text-center">                     
                                  <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
          
              <li><a href="#timeline{{$partenaire->id}}" class="active" data-toggle="tab">Contacts</a></li>
              <li><a href="#timeline1{{$partenaire->id}}" data-toggle="tab">Stages</a></li>
           
            </ul>

            <div class="tab-content">

            <div class="tab-pane active" id="timeline{{$partenaire->id}}">
               
          
            <table id="example1{{$partenaire->id}}" class="table table-bordered table-striped">
                <thead>
                <tr><th>Nom</th>
                  <th>Prenom</th>
                   <th>Actions</th>
                 
                </tr>
                </thead>
                <tbody> 
                  <!-- modifier -->    
                  @foreach ($partenaire->contacts as $contact) 
                  <tr>
                  <td>{{$contact->nom}}</td>
                    <td>{{$contact->prenom}}</td>
                    <td>   <div class="btn-group">
                        <form action="{{ url('contacts/'.$contact->id)}}" method="post">
                          
                          {{csrf_field()}}
                          {{method_field('DELETE')}}

                        <a href="{{ url('contacts/'.$contact->id.'/details')}}" class="btn btn-info">
                            <i class="fa fa-eye"></i>
                        </a>
                        @if(Auth::user()->role->nom == 'admin' )
                        <a href="{{ url('contacts/'.$contact->id.'/edit')}}" class="btn btn-default">
                          <i class="fa fa-edit"></i>
                        </a>
                        @endif
                        @if( Auth::user()->role->nom != 'membre' )
                        <button type="submit" class="btn btn-danger ">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        @endif
                        </form>
                      </div>
                      
                    </td>
                  </tr>
                  @endforeach        </tbody>
                <tfoot>
                <tr>
                <th>Nom</th>
                  <th>Prenom</th>
           
                  <th>Actions</th>
               
                </tr>
                </tfoot>
              </table>
            </div>  
            

            <div class="tab-pane" id="timeline1{{$partenaire->id}}">
               
          
               <table id="example2{{$partenaire->id}}" class="table table-bordered table-striped">
                 <thead>
                 <tr><th>Titre</th>
                   <th>Sujet</th>
                   <th>Stagiere</th>
                    <th>Actions</th>
                  
                 </tr>
                 </thead>
                 <tbody> 
                   <!-- modifier -->    
                   @foreach ($partenaire->stages as $stage) 
                   <tr>
                   <td>{{$stage->titre}}</td>
                   <td>{{$stage->sujet}}</td>
                     <td>{{$stage->user->name}} {{$stage->user->prenom}}</td>
                     <td>   <div class="btn-group">
                         <form action="{{ url('stages/'.$stage->id)}}" method="post">
                           
                           {{csrf_field()}}
                           {{method_field('DELETE')}}
 
                         <a href="{{ url('stages/'.$stage->id.'/details')}}" class="btn btn-info">
                             <i class="fa fa-eye"></i>
                         </a>
                         @if(Auth::user()->role->nom == 'admin' )
                         <a href="{{ url('stages/'.$stage->id.'/edit')}}" class="btn btn-default">
                           <i class="fa fa-edit"></i>
                         </a>
                         @endif
                         @if( Auth::user()->role->nom != 'membre' )
                         <button type="submit" class="btn btn-danger ">
                             <i class="fa fa-trash-o"></i>
                         </button>
                         @endif
                         </form>
                       </div>
                       
                     </td>
                   </tr>
                   @endforeach        </tbody>
                 <tfoot>
                  <tr><th>Titre</th>
                    <th>Sujet</th>
                    <th>Stagiere</th>
                     <th>Actions</th>
                   
                  </tr>
                 </tfoot>
               </table>
             </div>  
            
            







 </div>
            </div> </div>
                                  <div class="modal-footer">
                                      <form class="form-inline" action="{{ url('partenaires/'.$partenaire->id)}}"  method="POST">
                                          @method('DELETE')
                                          @csrf
                                      <button type="button" class="btn btn-light" data-dismiss="modal">Non</button>
                                          <button type="submit" class="btn btn-danger">Oui</button>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      @endif
                    </div>

                    <div class="widget-user-header bg-aqua-active">
                      <a class="users-list-name1" href="{{ url('partenaires/'.$partenaire->id.'/details')}}"><h3 class="widget-user-username">{{$partenaire->nom}}</h3></a>
                      <h5 class="widget-user-desc">{{$partenaire->types}}</h5>
                    </div>
                    <div class="widget-user-image">
                      <img class="img-circle" src="{{asset($partenaire->logo)}}" alt="User Avatar">
                    </div>
                    <div class="box-footer" style="height: 100px;">
                      <div class="row">
                        @foreach($nbr as $nbrs)
                        @if($nbrs->partenaire_id == $partenaire->id)
                        <div class="col-sm-4 border-right">
                          <div class="description-block">
                            <h5 class="description-header">
                             
                             {{$nbrs->total}}
                            
                          </h5>
                            <span class="description-text">Contacts</span>
                          </div>
                        </div>
                        @endif
                       
                         @endforeach

                       

                        <!-- <div class="col-sm-4">
                          <div class="description-block">
                            <h5 class="description-header">20</h5>
                            <span class="description-text">Publications</span>
                          </div>
                        </div> -->
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                  </div>
                  <!-- /.widget-user -->
                </div>

             
              @endforeach
            </div>
          </div>
            <!-- /.box-body -->
        </div>
        
      </div>
    </div>
  </div>

@endsection