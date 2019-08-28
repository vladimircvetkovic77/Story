<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      @include('layouts/headscripts')
      <title>Search</title>
      @include('layouts/navigation')
      <style type="text/css">
         *.unselectable {
         -moz-user-select: none;
         -khtml-user-select: none;
         -webkit-user-select: none;
         -ms-user-select: none;
         user-select: none;
         }
         .hide {
         visibility: hidden;
         }

         .lowOpacity {
        
          opacity: 0.3;
          color: greyt;
         }
         input,
         label {
           display: inline-block;
           margin-bottom: 0; 
           vertical-align: middle; 
         }
      
     
      </style>
   </head>
   <body>
      @csrf
      <div class="containter unselectable buttons">
         <div class="content-wrapper    unselectable" style="margin: 30px;">
            <form>
               <input class="form-control" id="searchField" type="" name="search" placeholder="Search" aria-label="Search" style="width: 300px; margin: 30px;">
               <!--  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
            </form>
             <button type="button" id="button3" class="btn btn-outline-danger" style="position: fixed; bottom: 20px; right:175px;">Hide selection</button>

              <button type="button" id="button4" class="btn btn-outline-primary" style="position: fixed; bottom: 20px; right:20px;">Show selection</button>


            <div id="myDiv" style="min-height: 100px;">
               @foreach($list as $maintree)
               <nav role='navigation'>
                  <div class="tree unselectable" unselectable="on">
                     <ul style="list-style: none;">
                        <li>
                           <input type="checkbox" id="{{$maintree->id}}" class="treeCheckBox selection" value="{{ $maintree->name }}">
                           <input type="checkbox" id="{{$maintree->id}}" class="lowOpacity treeCheckBox2" value="{{ $maintree->name }}" style="display: none">
                           <strong><label class="treeLabel" id="{{$maintree->id}}">  &nbsp;&nbsp; {!! $maintree->icon !!} &nbsp;&nbsp;{{ $maintree->name }} <small> 
                           @if( $maintree->branches->count()) 
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <a class="treeLabel treePlus-{{$maintree->id}} unselectable"><i class="fas fa-angle-down treeLabel" id="{{$maintree->id}}" style="color: blue; font-size: 15px;"></i></a>
                           <a class="treeLabel treeMinus-{{$maintree->id}} unselectable" style="display: none; color: blue; font-size: 15px;"><i class="fas fa-angle-right treeLabel" id="{{$maintree->id}}" ></i></a>  
                           @endif </small></label></strong> 
                           @foreach($maintree->branches as $branch)
                           <div class="branch maintree-{{ $maintree->id }} unselectable" id="maintree-{{ $maintree->id }}" unselectable="on">
                              <ul style="list-style: none;">
                                 <li>

                                    <input type="checkbox" name="branchBox" id="{{$branch->id}}" class="branchCheckBox maintree-{{ $maintree->id }} selection" style="margin-bottom: px;" value="{{ $maintree->name }} / {{ $branch->name }}">
                                    <input type="checkbox" id="{{$branch->id}}" class="lowOpacity branchCheckBox2 maintree-{{ $maintree->id }}" style="display: none" value="{{ $branch->name }}">
                                    <label class="branchLabel" id="{{$branch->id}}">  &nbsp;&nbsp; {!! $branch->icon !!} &nbsp;&nbsp; {{ $branch->name }} <small> 
                                    @if( $branch->leaves->count()) 
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="branchLabel branchPlus-{{$branch->id}} unselectable"><i class="fas fa-angle-right branchLabel" id="{{$branch->id}}" style="color: blue; font-size: 15px;"></i></a>
                                    <a class="branchLabel branchMinus-{{$branch->id}} unselectable" style="display: none; color: blue; font-size: 15px;"><i class="fas fa-angle-down branchLabel" id="{{$branch->id}}" ></i></a>  
                                    @endif 
                                    </small></label>
                                 </li>
                                 @foreach($branch->leaves as $leaf)
                                 <div class="leaf branch-{{ $branch->id }} maintree-{{ $maintree->id }}" style="display:none" id="branch-{{ $branch->id }}" unselectable="on">
                                    <ul style="list-style: none;">
                                       <li id="list">
                                          <input type="checkbox" id="{{$leaf->id}}" class="leafCheckBox selection maintree-{{$maintree->id}} branchCb-{{$branch->id}} " value="{{ $maintree->name }} / {{ $branch->name }} / {{ $leaf->name }}">
                                          <label> &nbsp;&nbsp; {!! $leaf->icon !!} &nbsp;&nbsp; {{ $leaf->name }}</label>
                                       </li>
                                    </ul>
                                 </div>
                                 @endforeach
                              </ul>
                           </div>
                           @endforeach
                        </li>
                     </ul>
                  </div>
               </nav>
               @endforeach
               <button type="button" id="button1" class="btn btn-danger" style="margin-left: 35px; display: none;">Cancel</button>
               <button type="button" id="button2" class="btn btn-success" style="display: none;">Apply</button>
            </div>
         </div>
      </div>
        <div id="successMessage" class="alert alert-success" role="alert" style="position: fixed; bottom: 70px; right:20px; display: none; width: 600px; overflow-y:scroll; height:400px;"> You have not selected anything</div>
        <span id="successMessageSpan" style="font-size: 11.5px; font-style: italic; color: red; position: fixed; bottom: 65px; right:420px; display: none;">The selection result is scrollable</span>

      @include('layouts/messages') 
      @include('layouts/bottomscripts')
   </body>

   <script src="{{ asset('js/myjquery.js') }}"></script>
  
</html>