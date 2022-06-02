local Library = loadstring(game:HttpGet("https://raw.githubusercontent.com/xHeptc/Kavo-UI-Library/main/source.lua"))()
local Window = Library.CreateLib("AnimeWare", colors)
local Tab = Window:NewTab("Main")
local Tab2 = Window:NewTab("Ui Settings")
local Section = Tab:NewSection("Main")
local Section69 = Tab2:NewSection("customizable Ui")
local Section1 = Window:NewTab("misc")
local Section2 = Section1:NewSection("Misc")
------------------------------------------------------------>
local Workspace = game:GetService("Workspace")
local Players = game.Players.LocalPlayer
local Character = Players.Character
----------------------------------------------------------->
local colors = {
    SchemeColor = Color3.fromRGB(0,255,255),
    Background = Color3.fromRGB(0, 0, 0),
    Header = Color3.fromRGB(0, 0, 0),
    TextColor = Color3.fromRGB(255,255,255),
    ElementColor = Color3.fromRGB(20, 20, 20)
}
------------------------------------------------------------>
for colors, color in pairs(colors) do
    Section69:NewColorPicker(colors, "Change your "..colors, color, function(color3)
        Library:ChangeColor(colors, color3)
    end)
end


Section:NewKeybind("Toggle Ui", "set key to o/c ui", Enum.KeyCode.F, function()
    Library:ToggleUI()
end)


Section:NewButton("Silent aim", "A bit laggy", function()
    loadstring(game:HttpGet("https://raw.githubusercontent.com/2dgeneralspam1/scripts-and-stuff/master/scripts/LoadstringVbyQoVG4Dx0m", true))()
end)


Section:NewButton("Knife Aura", "Use it, it make everything better.", function()
    function nearestPlayer()
        local dist = math.huge
        local ray
        
        for i,v in pairs(game.Players:GetChildren()) do
            if v ~= game.Players.LocalPlayer and v.Character and v.Character:FindFirstChild("Humanoid") and v.Character:FindFirstChild("Head") and not v.Character:FindFirstChild("ForceField") then
                if v.Character.Humanoid.Health > 0 and v.Character:FindFirstChild("Head") then -- needed..
                    local newVec = (v.Character.Head.Position - game.Players.LocalPlayer.Character.Head.Position)
                    if newVec.magnitude < dist then
                        local toRay = Ray.new(game.Players.LocalPlayer.Character.Head.Position, newVec)
                        if not workspace:FindPartOnRayWithIgnoreList(toRay, {game.Players.LocalPlayer.Character, v.Character, workspace.WorldIgnore, workspace.CurrentCamera}) then
                            dist = newVec.magnitude
                            ray = toRay
                        end
                    end
                end
            end
        end
        return ray
    end
    
    local ray
    
    function init()
        local knife = game.Players.LocalPlayer.Character:WaitForChild("Knife")
        local scr = getsenv(knife.KnifeServer.KnifeClient)
        if scr then
            local ir = scr.inputReleased
            local u7 = debug.getupvalue(ir, 2)
            local cam = debug.getupvalue(ir, 5)
            debug.setupvalue(ir, 5, setmetatable({}, {
                __index = function(t,k)
                    if k == "ScreenPointToRay" then
                        if ray ~= nil then
                            return function() return ray end
                        end
                    end
                    return cam[k]
                end
            }))
        
            
            while wait(.1) do
                if game.Players.LocalPlayer.Character.Humanoid.Health == 0 then
                    break    
                end
                ray = nearestPlayer()
                if ray then
                    scr.inputDown()
                    u7.ChargeStart = -math.huge
                    ir()
                end
            end
        end
    end
    
    init()
    game.Players.LocalPlayer.CharacterAdded:connect(function()
        print("hi")
        wait()
        init()
    end)
end)

Section:NewButton("Knife spam", "use it with knife aura and no cooldown(HOT)", function()
    loadstring(game:HttpGet("https://textbin.net/raw/gyp6olnryl", true))()
end)
    
Section:NewButton("Esp", "Esp.", function()
    local lplr = game.Players.LocalPlayer
    local camera = game:GetService("Workspace").CurrentCamera
    local CurrentCamera = workspace.CurrentCamera
    local worldToViewportPoint = CurrentCamera.worldToViewportPoint
    
    local HeadOff = Vector3.new(0, 0.5, 0)
    local LegOff = Vector3.new(0,3,0)
    
    for i,v in pairs(game.Players:GetChildren()) do
        local BoxOutline = Drawing.new("Square")
        BoxOutline.Visible = false
        BoxOutline.Color = Color3.new(0,0,0)
        BoxOutline.Thickness = 1
        BoxOutline.Transparency = 1
        BoxOutline.Filled = false
    
        local Box = Drawing.new("Square")
        Box.Visible = false
        Box.Color = Color3.new(1,1,1)
        Box.Thickness = 1
        Box.Transparency = 1
        Box.Filled = false
    
        local HealthBarOutline = Drawing.new("Square")
        HealthBarOutline.Thickness = 1
        HealthBarOutline.Filled = false
        HealthBarOutline.Color = Color3.new(0,0,0)
        HealthBarOutline.Transparency = 1
        HealthBarOutline.Visible = false
    
        local HealthBar = Drawing.new("Square")
        HealthBar.Thickness = 1
        HealthBar.Filled = false
        HealthBar.Transparency = 1
        HealthBar.Visible = false
    
        function boxesp()
            game:GetService("RunService").RenderStepped:Connect(function()
                if v.Character ~= nil and v.Character:FindFirstChild("Humanoid") ~= nil and v.Character:FindFirstChild("HumanoidRootPart") ~= nil and v ~= lplr and v.Character.Humanoid.Health > 0 then
                    local Vector, onScreen = camera:worldToViewportPoint(v.Character.HumanoidRootPart.Position)
    
                    local RootPart = v.Character.HumanoidRootPart
                    local Head = v.Character.Head
                    local RootPosition, RootVis = worldToViewportPoint(CurrentCamera, RootPart.Position)
                    local HeadPosition = worldToViewportPoint(CurrentCamera, Head.Position + HeadOff)
                    local LegPosition = worldToViewportPoint(CurrentCamera, RootPart.Position - LegOff)
    
                    if onScreen then
                        BoxOutline.Size = Vector2.new(1000 / RootPosition.Z, HeadPosition.Y - LegPosition.Y)
                        BoxOutline.Position = Vector2.new(RootPosition.X - BoxOutline.Size.X / 2, RootPosition.Y - BoxOutline.Size.Y / 2)
                        BoxOutline.Visible = true
    
                        Box.Size = Vector2.new(1000 / RootPosition.Z, HeadPosition.Y - LegPosition.Y)
                        Box.Position = Vector2.new(RootPosition.X - Box.Size.X / 2, RootPosition.Y - Box.Size.Y / 2)
                        Box.Visible = true
    
                        HealthBarOutline.Size = Vector2.new(2, HeadPosition.Y - LegPosition.Y)
                        HealthBarOutline.Position = BoxOutline.Position - Vector2.new(6,0)
                        HealthBarOutline.Visible = true
    
                        HealthBar.Size = Vector2.new(2, (HeadPosition.Y - LegPosition.Y) / (game:GetService("Players")[v.Character.Name].NRPBS["MaxHealth"].Value / math.clamp(game:GetService("Players")[v.Character.Name].NRPBS["Health"].Value, 0, game:GetService("Players")[v.Character.Name].NRPBS:WaitForChild("MaxHealth").Value)))
                        HealthBar.Position = Vector2.new(Box.Position.X - 6, Box.Position.Y + (1 / HealthBar.Size.Y))
                        HealthBar.Color = Color3.fromRGB(255 - 255 / (game:GetService("Players")[v.Character.Name].NRPBS["MaxHealth"].Value / game:GetService("Players")[v.Character.Name].NRPBS["Health"].Value), 255 / (game:GetService("Players")[v.Character.Name].NRPBS["MaxHealth"].Value / game:GetService("Players")[v.Character.Name].NRPBS["Health"].Value), 0)
                        HealthBar.Visible = true
    
                        if v.TeamColor == lplr.TeamColor then
                            --- Our Team
                            BoxOutline.Visible = false
                            Box.Visible = false
                            HealthBarOutline.Visible = false
                            HealthBar.Visible = false
                        else
                            ---Enemy Team
                            BoxOutline.Visible = true
                            Box.Visible = true
                            HealthBarOutline.Visible = true
                            HealthBar.Visible = true
                        end
    
                    else
                        BoxOutline.Visible = false
                        Box.Visible = false
                        HealthBarOutline.Visible = false
                        HealthBar.Visible = false
                    end
                else
                    BoxOutline.Visible = false
                    Box.Visible = false
                    HealthBarOutline.Visible = false
                    HealthBar.Visible = false
                end
            end)
        end
        coroutine.wrap(boxesp)()
    end
    
    game.Players.PlayerAdded:Connect(function(v)
        local BoxOutline = Drawing.new("Square")
        BoxOutline.Visible = false
        BoxOutline.Color = Color3.new(0,0,0)
        BoxOutline.Thickness = 3
        BoxOutline.Transparency = 1
        BoxOutline.Filled = false
    
        local Box = Drawing.new("Square")
        Box.Visible = false
        Box.Color = Color3.new(1,1,1)
        Box.Thickness = 1
        Box.Transparency = 1
        Box.Filled = false
    
        local HealthBarOutline = Drawing.new("Square")
        HealthBarOutline.Thickness = 3
        HealthBarOutline.Filled = false
        HealthBarOutline.Color = Color3.new(0,0,0)
        HealthBarOutline.Transparency = 1
        HealthBarOutline.Visible = false
    
        local HealthBar = Drawing.new("Square")
        HealthBar.Thickness = 1
        HealthBar.Filled = false
        HealthBar.Transparency = 1
        HealthBar.Visible = false
    
        function boxesp()
            game:GetService("RunService").RenderStepped:Connect(function()
                if v.Character ~= nil and v.Character:FindFirstChild("Humanoid") ~= nil and v.Character:FindFirstChild("HumanoidRootPart") ~= nil and v ~= lplr and v.Character.Humanoid.Health > 0 then
                    local Vector, onScreen = camera:worldToViewportPoint(v.Character.HumanoidRootPart.Position)
    
                    local RootPart = v.Character.HumanoidRootPart
                    local Head = v.Character.Head
                    local RootPosition, RootVis = worldToViewportPoint(CurrentCamera, RootPart.Position)
                    local HeadPosition = worldToViewportPoint(CurrentCamera, Head.Position + HeadOff)
                    local LegPosition = worldToViewportPoint(CurrentCamera, RootPart.Position - LegOff)
    
                    if onScreen then
                        BoxOutline.Size = Vector2.new(1000 / RootPosition.Z, HeadPosition.Y - LegPosition.Y)
                        BoxOutline.Position = Vector2.new(RootPosition.X - BoxOutline.Size.X / 2, RootPosition.Y - BoxOutline.Size.Y / 2)
                        BoxOutline.Visible = true
    
                        Box.Size = Vector2.new(1000 / RootPosition.Z, HeadPosition.Y - LegPosition.Y)
                        Box.Position = Vector2.new(RootPosition.X - Box.Size.X / 2, RootPosition.Y - Box.Size.Y / 2)
                        Box.Visible = true
    
                        HealthBarOutline.Size = Vector2.new(2, HeadPosition.Y - LegPosition.Y)
                        HealthBarOutline.Position = BoxOutline.Position - Vector2.new(6,0)
                        HealthBarOutline.Visible = true
    
                        HealthBar.Size = Vector2.new(2, (HeadPosition.Y - LegPosition.Y) / (game:GetService("Players")[v.Character.Name].NRPBS["MaxHealth"].Value / math.clamp(game:GetService("Players")[v.Character.Name].NRPBS["Health"].Value, 0, game:GetService("Players")[v.Character.Name].NRPBS:WaitForChild("MaxHealth").Value)))
                        HealthBar.Position = Vector2.new(Box.Position.X - 6, Box.Position.Y + (1/HealthBar.Size.Y))
                HealthBar.Color = Color3.fromRGB(255 - 255 / (game:GetService("Players")[v.Character.Name].NRPBS["MaxHealth"].Value / game:GetService("Players")[v.Character.Name].NRPBS["Health"].Value), 255 / (game:GetService("Players")[v.Character.Name].NRPBS["MaxHealth"].Value / game:GetService("Players")[v.Character.Name].NRPBS["Health"].Value), 0)                    
                HealthBar.Visible = true
    
                        if v.TeamColor == lplr.TeamColor then
                            --- Our Team
                            BoxOutline.Visible = false
                            Box.Visible = false
                            HealthBarOutline.Visible = false
                            HealthBar.Visible = false
                        else
                            ---Enemy Team
                            BoxOutline.Visible = true
                            Box.Visible = true
                            HealthBarOutline.Visible = true
                            HealthBar.Visible = true
                        end
    
                    else
                        BoxOutline.Visible = false
                        Box.Visible = false
                        HealthBarOutline.Visible = false
                        HealthBar.Visible = false
                    end
                else
                    BoxOutline.Visible = false
                    Box.Visible = false
                    HealthBarOutline.Visible = false
                    HealthBar.Visible = false
                end
            end)
        end
        coroutine.wrap(boxesp)()
    end)
end)

Section:NewButton("No knife throw cool down", "??", function()
    local cons = {
        [10] = 0,
        [30] = 0.01
    }
    
    local KnifeClient = game.Players.LocalPlayer.Character:FindFirstChild('KnifeClient', true)
    
    if KnifeClient then
        local KnifeClientS = getsenv(KnifeClient)
       
        table.foreach(cons, function(i,v)
            setconstant(KnifeClientS.inputReleased, i, v)
        end)
       
        local old = KnifeClientS.PlayAnimation
       
        KnifeClientS.PlayAnimation = newcclosure(function(...)
            local Args = {...}
           
            if (Args[1] == 'Grab' or Args[1] == 'Charge' or string.find(Args[1], 'Slash')) then
                Args[2] = 0.05
                return old(unpack(Args))
            end
           
            return old(...)
        end)
    end
    
    game.Players.LocalPlayer.Character.ChildAdded:Connect(function(Child)
        if Child.Name == 'Knife' then
            local Element = getsenv(Child:FindFirstChild('KnifeClient', true))
           
            table.foreach(cons, function(i,v)
                setconstant(Element.inputReleased, i, v)
            end)
           
            local old = Element.PlayAnimation
           
            Element.PlayAnimation = newcclosure(function(...)
                local Args = {...}
               
                if (Args[1] == 'Grab' or Args[1] == 'Charge' or string.find(Args[1], 'Slash')) then
                    Args[2] = 0.05
                    return old(unpack(Args))
                end
               
                return old(...)
            end)
        end
    end)
    
end)
Section2:NewButton("Less lag", "makes the game looks ass", function()
    loadstring(game:HttpGet("https://pastebin.com/raw/gX9mR85X", true))()
end)

Section2:NewButton("Remove water", "Removes water", function()
    for i,v in pairs(children) do
		v:Destroy()
	end


	local descendants = game:GetService("Workspace").WorldIgnore.Ignore:GetDescendants()

	for i,v in pairs(descendants) do
		if v.Name == "Water" then
			v:Destroy()

		end

		local Descendants = game:GetService("Workspace").WorldIgnore.MapEffects:GetDescendants()

		for i,v in pairs(Descendants) do
			if v.Name == "WaterPosition" then
				v:Destroy()

			end

		end
	end
end)

Section2:NewButton("God mode", "can't kill", function()
    game:GetService("StarterGui"):SetCore("SendNotification", {
		Title = "AnimeWare";
		Text = "You cant kill with GodMode. Reset To Disable it.";
	})
    local player = game.Players.LocalPlayer
	while true do
		wait()
		if player.Character and player.Character:FindFirstChild("HumanoidRootPart") then
			game.Workspace[player.Character.Name].CollisionParts:Destroy()
		end
	end
end)


Section2:NewButton("server hop", "change the server", function()
local x = {}
        for _, v in ipairs(game:GetService("HttpService"):JSONDecode(game:HttpGetAsync("https://games.roblox.com/v1/games/" .. game.PlaceId .. "/servers/Public?sortOrder=Asc&limit=100")).data) do
            if type(v) == "table" and v.maxPlayers > v.playing and v.id ~= game.JobId then
                x[#x + 1] = v.id
            end
        end
        if #x > 0 then
            game:GetService("TeleportService"):TeleportToPlaceInstance(game.PlaceId, x[math.random(1, #x)])
        else
            game.StarterGui:SetCore("SendNotification", {
                Title = "AnimeWare";
                Text = "Failed 2 Find Server";
                Duration = 3;
            })
            wait(0)
        end
end)

Section2:NewButton("server rejoin", "Rejoins same server", function()
local tpservice= game:GetService("TeleportService")
local plr = game.Players.LocalPlayer

tpservice:Teleport(game.PlaceId, plr)
end)

Section:NewButton("Talk trash", "(J)", function()
local plr = game.Players.LocalPlayer
repeat wait() until plr.Character
local char = plr.Character

local garbage = {
    "ur bad";
    "nice try bud";
    "ez";
    "my grandma has more skill than you";
    "trash";
    "you knocked out";
    "fell asleep";
    "waste of life";
    "where you aiming?";
    "Down baddd";
    "Well... that was easy";
    "imagine being you right now";
    "planted like a seed";
    "you smell";
    "night night :3";
    "why do you even try";
    "I didn't think being this bad was possible";
    "leave";
    "no skill";
    "you thought";
    "focus up son";
    "you're nothing";
    "scrambled like an egg";
    "flooded like an omlet";
    "so trash";
    "dog water";
    "damn bro maybe next time";
    "salty";
    "ur mad son";
    "cry more";
    "keep crying";
    "cry baby";
    "hahaha I won";
    "my bvalls are better than yours";
    "darn";
    "thank you for your time";
    "you were so close! easy!";
    "better luck next time!";
    "AnimeWare Is so good";
    "MADDD";
    "just cry more";
    "/e dab";
    "time to take out the trash";
    "did you get worse?";
    "I'm surprised you haven't quit yet";
    "that shouldn't take long";
    "bruh so bad.";
}
function TrashTalk(inputObject, gameProcessedEvent)
    if inputObject.KeyCode == Enum.KeyCode.J and gameProcessedEvent == false then
        game.ReplicatedStorage.DefaultChatSystemChatEvents.SayMessageRequest:FireServer(
            garbage[math.random(1,#garbage)],
            "All"
        )
    end
end
game:GetService("UserInputService").InputBegan:connect(TrashTalk)
end)

Section2:NewDropdown("Clinet sided stuff", "Al3ntel got a big pp", {"Right Korblox","Left Korblox","HeadLess"}, function(name)
    if name == "Right Korblox" then
        local ply = game.Players.LocalPlayer
        local chr = ply.Character
        chr.RightLowerLeg.MeshId = "902942093"
        chr.RightLowerLeg.Transparency = "1"
        chr.RightUpperLeg.MeshId = "http://www.roblox.com/asset/?id=902942096"
        chr.RightUpperLeg.TextureID = "http://roblox.com/asset/?id=902843398"
        chr.RightFoot.MeshId = "902942089"
        chr.RightFoot.Transparency = "1"
    elseif name == "Left Korblox" then
        local ply = game.Players.LocalPlayer
        local chr = ply.Character
        chr.LeftLowerLeg.MeshId = "902942093"
        chr.LeftLowerLeg.Transparency = "1"
        chr.LeftUpperLeg.MeshId = "http://www.roblox.com/asset/?id=902942096"
        chr.LeftUpperLeg.TextureID = "http://roblox.com/asset/?id=902843398"
        chr.LeftFoot.MeshId = "902942089"
        chr.LeftFoot.Transparency = "1"
    elseif name == "HeadLess" then
        game.Players.LocalPlayer.Character.Head.Transparency = 1
        for i,v in pairs(game.Players.LocalPlayer.Character.Head:GetChildren()) do
            if (v:IsA("Decal")) then
                v:Destroy()
            end
        end
    end
    end)
    
    Section2:NewDropdown("Face Changer", "Changes ur face", {"Blizzard Beast Mode", "PlayfulVampire", "happyface","JokerFace","LoveMoney","mad Face","Sad Noob :C","Big Stitch Face"}, function(name)
    if name == "Blizzard Beast Mode" then
        game.Players.LocalPlayer.Character.Head.face.Texture = "rbxassetid://209712379"
    elseif name == "PlayfulVampire" then
        game.Players.LocalPlayer.Character.Head.face.Texture = "rbxassetid://2409281591"
    elseif name == "happyface" then
        game.Players.LocalPlayer.Character.Head.face.Texture = "rbxassetid://494290547"
    elseif name == "JokerFace" then
        game.Players.LocalPlayer.Character.Head.face.Texture = "rbxassetid://1386948662"
    elseif name == "LoveMoney" then
        game.Players.LocalPlayer.Character.Head.face.Texture = "rbxassetid://945330361"
    elseif name == "mad Face" then
        game.Players.LocalPlayer.Character.Head.face.Texture = "rbxassetid://7293683132"
    elseif name == "Sad Noob :C" then
        game.Players.LocalPlayer.Character.Head.face.Texture = "rbxassetid://3533966871"
    elseif name == "Big Stitch Face" then
        game.Players.LocalPlayer.Character.Head.face.Texture = "rbxassetid://7205350525"
    end
    end)
    
