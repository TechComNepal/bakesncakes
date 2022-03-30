<x-cms-master-layout>


    <form action="{{ route('newsletters.subscribe') }}" method="post">
        @csrf
        <div class="row">
            <div class="col">
                <label for="email" class="sr-only">Email</label>
                <input type="text" name="email" class="form-control" placeholder="enter your email" required>
                @error('email')
                <div class="text text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col">
                <button type="submit" class="btn btn-danger mb-2">Subscribe</button>
            </div>

        </div>
    </form>
</x-cms-master-layout>