
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">
@php   

$to_loop_layout = panel_layout();
@endphp

@foreach($to_loop_layout['sort'] as $key=>$layout_sort_data)

@if(array_key_exists($key, $to_loop_layout))
@if(!$to_loop_layout[$key]['sub_menu']&&$to_loop_layout[$key]['link']==null)

@elseif(!$to_loop_layout[$key]['sub_menu'])
@php
$link = $to_loop_layout[$key]['link'];
$icon = $to_loop_layout[$key]['icon'];
@endphp

        <li class="{{$key==$main_menu ?'active':''}}">
          <a href="{{url($link)}}">
            <i class="{{$icon}}"></i> <span>@lang('pages_names.'.$key)</span>
          </a>
        </li>
@else
@php
$icon = $to_loop_layout[$key]['icon'];
@endphp

        <li class="treeview {{ $main_menu == $key ? 'active menu-open' : '' }}">
          <a href="javascript: void(0);">
            <i class="{{$icon}}"></i>
            <span> @lang('pages_names.'.$key) </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>

        <ul class="treeview-menu">
@foreach($to_loop_layout[$key] as $sub_layout_key=>$sub_layout_value)

@if($sub_layout_key!='sub_menu'&&$sub_layout_key!='icon'&&$sub_layout_key!='link')

@php
$sub_link = $sub_layout_value['link'];
@endphp
            <li class="{{$sub_menu==$sub_layout_key ? 'active' : '' }}">
                <a href="{{url($sub_link)}}"><i class="fa fa-circle-thin"></i>@lang('pages_names.'.$sub_layout_key)</a>
            </li>

@endif
@endforeach
        </ul>
        </li>        
        
@endif
@endif
@endforeach
      </ul>
    </section>
  </aside>
