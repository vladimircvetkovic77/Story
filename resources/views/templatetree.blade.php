<div id="myDiv" style="min-height: 100px;">
   
   @foreach($trees as $tree)
   <nav role='navigation'>
      <div class="tree unselectable" unselectable="on">
         <ul style="list-style: none;">
            <li>
               <input type="checkbox" id="{{$tree->id}}" class="treeCheckBox">
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
                       </small>
               @endforeach
               </label>
               </strong> 
               @foreach($branches as $branch) 
               @if($branch->tree_id === $tree->id)
               <div class="branch maintree-{{ $tree->id }}" id="tree-{{ $tree->id }} unselectable" unselectable="on">
                  <ul style="list-style: none;">
                     <li>
                        <input type="checkbox" id="{{$branch->id}}" class="branchCheckBox maintree-{{ $tree->id }}">
                        <label class="branchLabel" id="{{$branch->id}}"> &nbsp;&nbsp; {!! $branch->icon !!} &nbsp;&nbsp; {{ $branch->name }} 
                        <small> 
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
                            </small> 
                        @endforeach
                        </small>
                        </label>
                     </li>
                     @foreach($leaves as $leaf) 
                     @if($leaf->branch_id === $branch->id)
                     <div class="leaf branch-{{ $branch->id }}" id="branch-{{ $branch->id }}" unselectable="on">
                        <ul style="list-style: none;">
                           <li>
                              <input type="checkbox" id="{{$leaf->id}}" class="leafCheckBox maintree-{{ $tree->id }} branchCb-{{$branch->id}} ">
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
   <button type="button" class="btn btn-danger" style="margin-left: 35px;">Cancel</button>
   <button type="button" class="btn btn-success">Apply</button>
</div>
</div>
</div>