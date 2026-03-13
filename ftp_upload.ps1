# FTP Upload Script for Gardi Bazar to ProFreeHost
$ftpHost = "ftpupload.net"
$ftpUser = "ezyro_41376688"
$ftpPass = "a5d770cee"
$localPath = "C:\Users\IT\Desktop\bazargardi"
$ftpBase = "ftp://${ftpHost}/htdocs"

# Directories to skip
$skipDirs = @('.git', 'node_modules', 'tests', '.gemini', '.vscode')
$skipFiles = @('ftp_upload.ps1', 'database_export.sql', '.gitignore', '.gitattributes', '.editorconfig', 'phpunit.xml', 'vite.config.js', 'package.json', 'package-lock.json')

function Upload-FTPFile {
    param (
        [string]$localFile,
        [string]$remotePath
    )
    
    try {
        $ftpUri = "$ftpBase/$remotePath"
        $request = [System.Net.FtpWebRequest]::Create($ftpUri)
        $request.Method = [System.Net.WebRequestMethods+Ftp]::UploadFile
        $request.Credentials = New-Object System.Net.NetworkCredential($ftpUser, $ftpPass)
        $request.UseBinary = $true
        $request.UsePassive = $true
        $request.KeepAlive = $false
        $request.Timeout = 60000
        
        $fileContent = [System.IO.File]::ReadAllBytes($localFile)
        $request.ContentLength = $fileContent.Length
        
        $stream = $request.GetRequestStream()
        $stream.Write($fileContent, 0, $fileContent.Length)
        $stream.Close()
        
        $response = $request.GetResponse()
        $response.Close()
        
        Write-Host "OK: $remotePath" -ForegroundColor Green
        return $true
    }
    catch {
        Write-Host "FAIL: $remotePath - $($_.Exception.Message)" -ForegroundColor Red
        return $false
    }
}

function Create-FTPDirectory {
    param (
        [string]$remotePath
    )
    
    try {
        $ftpUri = "$ftpBase/$remotePath"
        $request = [System.Net.FtpWebRequest]::Create($ftpUri)
        $request.Method = [System.Net.WebRequestMethods+Ftp]::MakeDirectory
        $request.Credentials = New-Object System.Net.NetworkCredential($ftpUser, $ftpPass)
        $request.UsePassive = $true
        $request.KeepAlive = $false
        
        $response = $request.GetResponse()
        $response.Close()
        Write-Host "DIR: $remotePath" -ForegroundColor Cyan
    }
    catch {
        # Directory may already exist
    }
}

function Upload-Directory {
    param (
        [string]$localDir,
        [string]$remoteDir
    )
    
    # Create remote directory
    if ($remoteDir -ne "") {
        Create-FTPDirectory $remoteDir
    }
    
    # Upload files in this directory
    $files = Get-ChildItem -Path $localDir -File
    foreach ($file in $files) {
        if ($skipFiles -contains $file.Name) { continue }
        
        $remotePath = if ($remoteDir -ne "") { "$remoteDir/$($file.Name)" } else { $file.Name }
        Upload-FTPFile $file.FullName $remotePath
    }
    
    # Recurse into subdirectories
    $dirs = Get-ChildItem -Path $localDir -Directory
    foreach ($dir in $dirs) {
        if ($skipDirs -contains $dir.Name) { continue }
        
        $remotePath = if ($remoteDir -ne "") { "$remoteDir/$($dir.Name)" } else { $dir.Name }
        Upload-Directory $dir.FullName $remotePath
    }
}

Write-Host "========================================" -ForegroundColor Yellow
Write-Host "  Uploading Gardi Bazar to ProFreeHost" -ForegroundColor Yellow
Write-Host "========================================" -ForegroundColor Yellow
Write-Host ""

$startTime = Get-Date
Upload-Directory $localPath ""
$endTime = Get-Date
$duration = $endTime - $startTime

Write-Host ""
Write-Host "========================================" -ForegroundColor Yellow
Write-Host "  Upload Complete! Duration: $($duration.ToString('hh\:mm\:ss'))" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Yellow
