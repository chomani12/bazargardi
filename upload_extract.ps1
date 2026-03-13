# Upload extract.php to ProFreeHost
$ftpHost = "ftpupload.net"
$ftpUser = "ezyro_41376688"
$ftpPass = "a5d770cee"

$ftpUri = "ftp://${ftpHost}/htdocs/extract.php"
$localFile = "C:\Users\IT\Desktop\bazargardi\extract.php"

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

Write-Host "extract.php uploaded successfully!" -ForegroundColor Green
