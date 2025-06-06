document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.favorite-btn').forEach(button => {
        button.addEventListener('click', function () {
            const estateId = this.dataset.id;
            console.log("Sending ID:", estateId);
            const btn = this;

            fetch("/favorites/toggle", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    real_estate_id: estateId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'added') {
                    btn.innerText = 'Remove from Favorites';
                    btn.classList.remove('bg-blue-500');
                    btn.classList.add('bg-red-500');
                } else {
                    btn.innerText = 'Add to Favorites';
                    btn.classList.remove('bg-red-500');
                    btn.classList.add('bg-blue-500');
                }
            });
        });
    });
});
