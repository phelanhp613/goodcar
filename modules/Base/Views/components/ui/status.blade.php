@php use Modules\Base\Models\Status; @endphp
@if ($status == 0)
    <span class="badge bg-danger text-white badge-status">{{ Status::getStatus($status) }}</span>
@elseif($status == 1)
    <span class="badge bg-success badge-status">{{ Status::getStatus($status) }}</span>
@else
    <span class="badge bg-warning badge-status">{{ Status::getStatus($status) }}</span>
@endif