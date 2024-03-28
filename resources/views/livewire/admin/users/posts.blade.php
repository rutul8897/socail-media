<div>
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Caption
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Total Likes
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Total Comments
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Creation Date
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $post->caption }}</p>
                    </td>
                    <td class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $post->postLikes->count() }}</p>
                    </td>
                    <td class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $post->postComments->count() }}</p>
                    </td>
                    <td class="text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $post->created_at }}</span>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <p class="text-center font-weight-bold mb-0">No Posts Found.</p>
                        </td>
                    </tr>
                @endforelse
        </tbody>
    </table>
</div>
</div>
