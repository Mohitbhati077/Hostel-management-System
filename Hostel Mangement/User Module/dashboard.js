// document.addEventListener('DOMContentLoaded', function () {
//     const viewMoreButton = document.getElementById('viewMoreNotices');
//     const noticeList = document.querySelector('#notice ul');
    
//     // Function to display remaining notices
//     function showRemainingNotices() {
//         for (let i = 2; i < notices.length; i++) {
//             const notice = notices[i];
//             const li = document.createElement('li');
//             li.innerHTML = `<strong>${notice.title}</strong><p>${notice.message}</p>`;
//             noticeList.appendChild(li);
//         }
        
//         // Hide the "View More Notices" button after displaying all notices
//         viewMoreButton.style.display = 'none';
//     }

//     // Attach a click event to the "View More Notices" button
//     if (viewMoreButton) {
//         viewMoreButton.addEventListener('click', showRemainingNotices);
//     }
// });
