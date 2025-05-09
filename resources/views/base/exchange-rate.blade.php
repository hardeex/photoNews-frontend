 <!-- Exchange Rate Ticker Component -->
 <div class="relative overflow-hidden">
    <marquee onmouseover="stop()" onmouseout="start()" scrollamount="10" class="marquee"
        style="display: flex; background-color:rgba(0,0,0,0.9); padding: 5px">
        <ul
            style="
  width: 100%;
  list-style: none;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 30px;
">
            <!-- -------------------------------- -->
            <li
                style="
    font-size: 12px;
    list-style: none;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2px;
    border-right: 1px solid #ffffffdc;
    padding-right: 10px;
  ">
                <img src="countries/GB.png" width="20px" alt="" />&nbsp;<span
                    style="color: #ffffff">EUR</span>
                <span style="color: #21ca07">1.00</span>
                &nbsp;
                <img src="countries/NG.png" width="20px" alt="" />&nbsp;<span
                    style="color: #ffffff">NGN</span>
                <span style="color: #ff0303">650.00</span> <!-- Static data for GBP to NGN rate -->
            </li>
            <!-- -------------------------------- -->
            <li
                style="
    font-size: 12px;
    list-style: none;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2px;
    border-right: 1px solid #ffffffdc;
    padding-right: 10px;
  ">
                <img src="countries/EUR.png" width="20px" alt="" />&nbsp;<span
                    style="color: #ffffff">GDP</span>
                <span style="color: #21ca07">1.00</span>
                &nbsp;
                <img src="countries/NG.png" width="20px" alt="" />&nbsp;<span
                    style="color: #ffffff">NGN</span>
                <span style="color: #ff0303">750.00</span> <!-- Static data for EUR to NGN rate -->
            </li>
            <!-- -------------------------------- -->
            <li
                style="
    font-size: 12px;
    list-style: none;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2px;
    border-right: 1px solid #ffffffdc;
    padding-right: 10px;
  ">
                <img src="countries/USA.png" width="20px" alt="" />&nbsp;<span
                    style="color: #ffffff">USA</span>
                <span style="color: #21ca07">1.00</span>
                &nbsp;
                <img src="countries/NG.png" width="20px" alt="" />&nbsp;<span
                    style="color: #ffffff">NGN</span>
                <span style="color: lightgreen;">880.00</span> <!-- Static data for USD to NGN rate -->
            </li>
            <!-- -------------------------------- -->
            <li
                style="
    font-size: 12px;
    list-style: none;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2px;
    border-right: 1px solid #ffffffdc;
    padding-right: 10px;
  ">
                <img src="countries/SA.png" width="20px" alt="" />&nbsp;<span
                    style="color: #ffffff">SA</span>
                <span style="color: #21ca07">1.00</span>
                &nbsp;
                <img src="countries/NG.png" width="20px" alt="" />&nbsp;<span
                    style="color: #ffffff">NGN</span>
                <span style="color: #ff0303">235.00</span> <!-- Static data for SAR to NGN rate -->
            </li>
            <!-- -------------------------------- -->
            <li
                style="
    font-size: 12px;
    list-style: none;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2px;
    border-right: 1px solid #ffffffdc;
    padding-right: 10px;
  ">
                <img src="countries/JPN.png" width="20px" alt="" />&nbsp;<span
                    style="color: #ffffff">JPN</span>
                <span style="color: #21ca07">1.00</span>
                &nbsp;
                <img src="countries/NG.png" width="20px" alt="" />&nbsp;<span
                    style="color: #ffffff">NGN</span>
                <span style="color: #ff0303">930.00</span> <!-- Static data for JPY to NGN rate -->
            </li>
            <!-- -------------------------------- -->
            <li
                style="
    font-size: 12px;
    list-style: none;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2px;
    border-right: 1px solid #ffffffdc;
    padding-right: 10px;
  ">
                <img src="countries/GH.png" width="20px" alt="" />&nbsp;<span
                    style="color: #ffffff">GHN</span>
                <span style="color: #21ca07">1.00</span>
                &nbsp;
                <img src="countries/NG.png" width="20px" alt="" />&nbsp;<span
                    style="color: #ffffff">NGN</span>
                <span style="color: #ff0303">125.00</span> <!-- Static data for GHS to NGN rate -->
            </li>
        </ul>
    </marquee>
</div>

<style>
    @keyframes ticker {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .animate-ticker {
        animation: ticker 30s linear infinite;
    }
</style>
</div> 