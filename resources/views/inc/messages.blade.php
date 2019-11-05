@if(count($errors) > 0)

    @foreach($errors->all() as $error)
        <script>
            toastr.error("<?php echo $error; ?>");
        </script>
    @endforeach

@endif
@if(session('success'))
    <?php
        $message = session('success');
    ?>
    <script>
        toastr.success("<?php echo $message; ?>");
    </script>
    @php
        session()->forget('success');
    @endphp
@endif
@if(session('error'))
    <?php
        $err_message = session('error');
    ?>
    <script>
        toastr.error("<?php echo $err_message; ?>");
    </script>
@endif