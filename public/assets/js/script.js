// show sidebar
document.getElementById('sidebarButton').addEventListener('click', () => {
    document.getElementById('sidebar').classList.remove('hidden');
});

// hide sidebar
document.getElementById('closeSidebarButton').addEventListener('click', () => {
    document.getElementById('sidebar').classList.add('hidden');
});

// dropdown
document.getElementById('dropdownToggleButton').addEventListener('click', () => {
    document.getElementById('dropdownItems').classList.toggle('hidden');
    document.getElementById('caret').classList.toggle('fa-caret-down');
});