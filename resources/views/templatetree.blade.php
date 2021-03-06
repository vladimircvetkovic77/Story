<div id="myDiv" style="min-height: 100px;">
   
   @foreach($trees as $tree)
   <nav role='navigation'>
      <div class="tree unselectable" unselectable="on">
         <ul style="list-style: none;">
            <li>
              <input type="checkbox" id="{{$tree->id}}" class="treeCheckBox selection" value="{{ $tree->name }}">
              <input type="checkbox" id="{{$tree->id}}" class="lowOpacity treeCheckBox2" value="{{ $tree->name }}" style="display: none">
               <strong>
               <label class="treeLabel" id="{{$tree->id}}">  &nbsp;&nbsp; {!! $tree->icon !!} &nbsp;&nbsp;{{ $tree->name }}
               @php 
               $i = 0; 
               @endphp
                @foreach($branches as $branch)
                       @if($branch->tree_id === $tree->id)
                           @while($i<1)
                           
                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   <a class="treeLabel treePlus-{{$tree->id}} unselectable">
                                   <i class="fas fa-angle-down treeLabel" id="{{$tree->id}}" style="color: blue; font-size: 15px;"></i>
                                   </a>
                                   <a class="treeLabel treeMinus-{{$tree->id}} unselectable" style="display: none; color: blue; font-size: 15px;">
                                   <i class="fas fa-angle-right treeLabel" id="{{$tree->id}}" ></i>
                                   </a> 
                               
                               @php 
                               ++$i; 
                               @endphp 
                           
                           @endwhile
                       @endif 
                       
               @endforeach
               </label>
               </strong> 
               @foreach($branches as $branch) 
               @if($branch->tree_id === $tree->id)
               <div class="branch maintree-{{ $tree->id }} unselectable" id="tree-{{ $tree->id }}" unselectable="on">
                  <ul style="list-style: none;">
                     <li>
                       <input type="checkbox" name="branchBox" id="{{$branch->id}}" class="branchCheckBox maintree-{{ $tree->id }} selection" style="margin-bottom: px;" value="{{ $tree->name }} / {{ $branch->name }}">
                      <input type="checkbox" id="{{$branch->id}}" class="lowOpacity branchCheckBox2 maintree-{{ $tree->id }}" style="display: none" value="{{ $branch->name }}">
                        <label class="branchLabel" id="{{$branch->id}}"> &nbsp;&nbsp; {!! $branch->icon !!} &nbsp;&nbsp; {{ $branch->name }} 
                       
                        @php 
                        $l = 0; 
                        @endphp
                       
                        @foreach($leaves as $leaf)
                            @if($leaf->branch_id === $branch->id)
                                    @while($l<1)
                                        
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a class="branchLabel branchPlus-{{$branch->id}} unselectable">
                                        <i class="fas fa-angle-down branchLabel" id="{{$branch->id}}" style="color: blue; font-size: 15px;"></i>
                                        </a>
                                        <a class="branchLabel branchMinus-{{$branch->id}} unselectable" style="display: none; color: blue; font-size: 15px;">
                                        <i class="fas fa-angle-right branchLabel" id="{{$branch->id}}" ></i>
                                        </a> 

                                        @php 
                                        ++$l; 
                                        @endphp 

                                    @endwhile
                            @endif 
                           
                        @endforeach
                       
                        </label>
                     </li>
                     @foreach($leaves as $leaf) 
                     @if($leaf->branch_id === $branch->id)
                     <div class="leaf branch-{{ $branch->id }}" id="branch-{{ $branch->id }}" unselectable="on">
                        <ul style="list-style: none;">
                           <li>
                              <input type="checkbox" id="{{$leaf->id}}" class="leafCheckBox selection maintree-{{$tree->id}} branchCb-{{$branch->id}} " value="{{ $tree->name }} / {{ $branch->name }} / {{ $leaf->name }}">
                              <label> &nbsp;&nbsp; {!! $leaf->icon !!} &nbsp;&nbsp; {{ $leaf->name }}</label>
                           </li>
                        </ul>
                     </div>
                     @endif 
                     @endforeach
                  </ul>
               </div>
               @endif 
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