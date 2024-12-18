import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo.channel('message')
    .listen('MessageEvent', (e) => {
        const messageList = document.getElementById('messageList');

        if (!document.querySelector(`#message-${e.message.id}`)) {
            const li = document.createElement('li');
            li.id = `message-${e.message.id}`;
            li.classList.add('list-group-item');
            li.innerHTML = `
                <strong>${e.message.text}</strong><br>
                <img src="${e.message.image}" alt="Image" class="img-fluid mt-2" style="max-width: 200px;">
            `;
            messageList.appendChild(li);
        } else {
            console.log(`Duplicate message ignored: ${e.message.id}`);
        }
    });

window.Echo.channel('employee')
    .listen('EmployeeEvent', (e) => {
        const employeeTableBody = document.querySelector('tbody');

        // Find if the employee row already exists
        const existingRow = document.getElementById(`employee-${e.employee.id}`);

        if (existingRow) {
            // Update the existing row
            existingRow.innerHTML = `
                <td>${e.employee.id}</td>
                <td>${e.employee.name}</td>
                <td>${e.employee.phone}</td>
                <td>
                    <img src="${e.employee.image}" alt="Employee Image" width="100px">
                </td>
            `;
        } else {
            // Create a new row if it doesn't exist
            const newRow = document.createElement('tr');
            newRow.id = `employee-${e.employee.id}`;
            newRow.innerHTML = `
                <td>${e.employee.id}</td>
                <td>${e.employee.name}</td>
                <td>${e.employee.phone}</td>
                <td>
                    <img src="${e.employee.image}" alt="Employee Image" width="100px">
                </td>
            `;
            employeeTableBody.appendChild(newRow);
        }
    });


