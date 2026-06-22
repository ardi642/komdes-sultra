const fs = require('fs');
const path = require('path');

function walkDir(dir, callback) {
    fs.readdirSync(dir).forEach(f => {
        let dirPath = path.join(dir, f);
        let isDirectory = fs.statSync(dirPath).isDirectory();
        isDirectory ? walkDir(dirPath, callback) : callback(path.join(dir, f));
    });
}

walkDir('resources/views/livewire', function(filePath) {
    if (filePath.endsWith('.blade.php')) {
        let content = fs.readFileSync(filePath, 'utf8');
        let newContent = content.replace(/<div wire:loading wire:target="search, perPage/g, '<div wire:loading.flex wire:target="search, perPage');
        if (content !== newContent) {
            fs.writeFileSync(filePath, newContent);
            console.log('Fixed', filePath);
        }
    }
});
