<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ $route }}" method="POST" id="{{ $formId }}">
                @csrf
                @if ($method == 'PATCH')
                    @method('PATCH')
                @elseif ($method == 'DELETE')
                    @method('DELETE')
                @endif
                <div class="modal-header bg-{{ $color }}">
                    <h5 class="modal-title" id="{{ $modalId }}Label">{{ $modalTitle }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-{{ $color }}">{{ $buttonName }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
