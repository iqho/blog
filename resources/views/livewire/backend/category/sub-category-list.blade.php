<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    <?php $_SESSION['i']=$_SESSION['i']+1; ?>
    <tr>
        <td>{{$_SESSION['i']}}</td>
        <td>{{$dash}}{{$subcategory->name}}</td>
        <td>{{$subcategory->slug}}</td>
        <td>{{$subcategory->parent->name}}</td>
        <td style="padding: 0px; text-align:center">
            @if ($subcategory->image)
            <img src="{{ asset('storage/category-image/'.$category->image) }}" alt="{{ $subcategory->name }}" style="width: 40px; height:35px">
            @endif
        </td>
        <td>
        @if ($subcategory->status == 1)
        <button wire:click="updateStatus({{ $subcategory->id }})" class="btn btn-success">Active</button>
         @else
         <button wire:click="updateStatus({{ $subcategory->id }})" class="btn btn-danger">Inactive</button>
         @endif
         </button>
        </td>
        <td>
            @if(!empty($subcategory->user->name))
            {{ $subcategory->user->name }}
            @else
            Creator Not Found !
            @endif
        </td>
        <td style="max-width: 100px; text-align:center">{{ date('d-M-Y h:i a', strtotime($subcategory->created_at)); }}</td>
        <td style="text-align: center; max-width:50px;">
            <a href="#" data-bs-toggle="modal" data-id="1" data-bs-target="#updateCategoryModal" wire:click="edit({{ $subcategory->id }})"><i class="fas fa-edit fa-lg"></i></a> | <a href="#" onclick="confirm('Confirm Delete This Category ?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{ $subcategory->id }})"><i class="fas fa-trash-alt fa-lg" style="color:red"></i></a>
          </td>
    </tr>
    @if(count($subcategory->subcategory))
        @include('livewire.backend.category.sub-category-list', ['subcategories' => $subcategory->subcategory])
    @endif
@endforeach
