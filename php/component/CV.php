<div id="conRevCV" class="CV-view" style="--color: #000;">
    <div class=" CV-avatar">
        <img src="content/img/customers/customer-alice.jpg" />
    </div>
    <div class="CV-name-job">
        <div id="txtRevName" class="name">Isabel Schumacher</div>
        <div id="txtRevJob" class="job">Graphic Designers</div>
    </div>

    <div class="CV-personal-information">
        <div class="objective">
            <div class="CV-icon-title">
                <ion-icon name="accessibility"></ion-icon>
                <span class="title">Objective</span>
            </div>
            <div id="txtRevIntroduction"  class="details">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quia expedita, aut et illum quas atque impedit ad ex dolore voluptatem. Corrupti, iusto praesentium!
            </div>
        </div>
        <div class="contact">
            <div class="CV-icon-title">
                <ion-icon name="bookmark"></ion-icon>
                <span class="title">Contact</span>
            </div>
            <div class="details">
                <ion-icon name="mail"></ion-icon>
                <p id="txtRevEmail">schumacher@example.com</p>
                <ion-icon name="call"></ion-icon>
                <div id="conRevPhone">
                    <p>+919-263-1770</p>
                </div>
                <ion-icon name="location"></ion-icon>
                <div id="conRevAddress">
                    <p>123 Any Street</p>
                </div>
            </div>
        </div>
        <div class="skills">
            <div class="CV-icon-title">
                <ion-icon name="settings"></ion-icon>
                <span class="title">Skills</span>
            </div>
            <div class="details">
                <ul id="conRevSkill">
                    <li>Web design &mdash; 4 years</li>
                    <li>Branding &mdash; 2 years</li>
                    <li>Marketing &mdash; 2 years</li>
                    <li>SEO &mdash; 1 year</li>
                </ul>
            </div>
        </div>
        <div class="reference">
            <div class="CV-icon-title">
                <ion-icon name="attach"></ion-icon>
                <span class="title">Reference</span>
            </div>
            <div class="details">
                <ion-icon name="mail"></ion-icon>
                <p id="txtRevRefEmail">schumacher@example.com</p>
                <ion-icon name="call"></ion-icon>
                <p id="txtRevRefPhone">+919-263-1770</p>
            </div>
        </div>
        <div class="addition">
            <div class="CV-icon-title">
                <ion-icon name="information-circle"></ion-icon>
                <span class="title">Additional information</span>
            </div>
            <div id="txtRevOther" class="details">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam nemo ullam labore facere vero ipsa.
            </div>
        </div>
    </div>

    <div class="CV-personal-progress">
        <div class="CV-icon-title">
            <ion-icon name="school"></ion-icon>
            <span class="title">Education</span>
        </div>
        <div id="conRevEducation" class="personal-educations">
            <div class="personal-education">
                <div class="vertical-line">
                    <div class="line"></div>
                </div>
                <div class="years">(2011-2015)</div>
                <div class="university">Wardiere University</div>
                <div class="major">Computer Science</div>
                <div class="degree">Bachelor of Design</div>
                <div class="gpa">3.74</div>
            </div>
            <div class="personal-education">
                <div class="vertical-line">
                    <div class="line"></div>
                </div>
                <div class="years">(2015-2019)</div>
                <div class="university">Wardiere University</div>
                <div class="major">Computer Science</div>
                <div class="degree">Bachelor of Design</div>
                <div class="gpa">3.65</div>
            </div>
        </div>
        
        <div class="CV-icon-title">
            <ion-icon name="briefcase"></ion-icon>
            <span class="title">Experience</span>
        </div>
        <div id="conRevExperience" class="personal-experiences">
            <div class="personal-experience">
                <div class="vertical-line">
                    <div class="line"></div>
                </div>
                <div class="years">(2017-2019)</div>
                <div class="job">Junior graphic designer</div>
                <div class="company">Iarana, inc</div>
                <div class="employer">Dr. Robert J. Kelly</div>
                <ul class="achievement">
                    <li>create more than 100 graphic designs for big companies</li>
                    <li>complete a lot of complicated work</li>
                </ul>
            </div>
            <div class="personal-experience">
                <div class="vertical-line">
                    <div class="line"></div>
                </div>
                <div class="years">(2020-2024)</div>
                <div class="job">Senior graphic designer</div>
                <div class="company">Fauget studio</div>
                <div class="employer">Michael Andison</div>
                <ul class="achievement">
                    <li>create more than 200 graphic designs for big companies</li>
                    <li>complete a lot of complicated work</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function dataToCV(json_data){
        let data = JSON.parse(json_data);
        let title = data.title;
        let name = data.name;
        let job = data.job;
        let email = data.email;
        let introduction = data.introduction;
        let other = data.other;
        let ref_email = data.ref_email;
        let ref_phone = data.ref_phone;

        let phone = data.phone;
        let address = data.address;
        let skill = data.skill;
        let education = data.education; 
        let experience = data.experience; 
        
        let password = data.password;
        let color = data.color;
        let access_level = data.access_level;
        let allower = data.allower;


        document.getElementById("txtRevName").innerHTML = name;
        document.getElementById("txtRevJob").innerHTML = job;
        document.getElementById("txtRevEmail").innerHTML = email;
        document.getElementById("txtRevIntroduction").innerHTML = introduction;
        document.getElementById("txtRevOther").innerHTML = other;
        document.getElementById("txtRevRefEmail").innerHTML = ref_email;
        document.getElementById("txtRevRefPhone").innerHTML = ref_phone;

        
        const phone_container = document.getElementById("conRevPhone");
        removeAllChild(phone_container);
        for (let i = 0; i < phone.length; i++){
            let component = document.createElement("p");
            component.innerHTML = phone[i].number;
            phone_container.appendChild(component);
        }
        
        //RECHECK for adding country, state, city to review
        const address_container = document.getElementById("conRevAddress");
        removeAllChild(address_container);
        for (let i = 0; i < address.length; i++){
            let component = document.createElement("p");
            component.innerHTML = address[i].home;
            address_container.appendChild(component);
        }

        const skill_container = document.getElementById("conRevSkill");
        removeAllChild(skill_container);
        for (let i = 0; i < skill.length; i++){
            let component = document.createElement("li");
            component.innerHTML = skill[i].name + " - " + skill[i].year + " years";
            skill_container.appendChild(component);
        }

        const education_container =  document.getElementById("conRevEducation");
        removeAllChild(education_container);
        for (let i = 0; i < education.length; i++){
            let ele = education[i];
            // Create the parent div with class 'personal-education'
            const personalEducation = document.createElement('div');
            personalEducation.className = 'personal-education';

            // Create the vertical-line div
            const verticalLine = document.createElement('div');
            verticalLine.className = 'vertical-line';

            // Create the line div and append it to vertical-line
            const line = document.createElement('div');
            line.className = 'line';
            verticalLine.appendChild(line);

            // Create the years div and set its text content
            const years = document.createElement('div');
            years.className = 'years';
            years.textContent = '(' + ele.start_year + '-' + ele.end_year + ')';

            // Create the university div and set its text content
            const university = document.createElement('div');
            university.className = 'university';
            university.textContent = ele.university;
            
            // Create the major div and set its text content
            const major = document.createElement('div');
            major.className = 'major';
            major.textContent = ele.major;

            // Create the degree div and set its text content
            const degree = document.createElement('div');
            degree.className = 'degree';
            degree.textContent = ele.degree;

            // Create the gpa div and set its text content
            const gpa = document.createElement('div');
            gpa.className = 'gpa';
            gpa.textContent = ele.gpa;

            // Append all child elements to the personal-education div
            personalEducation.appendChild(verticalLine);
            personalEducation.appendChild(years);
            personalEducation.appendChild(university);
            personalEducation.appendChild(major);
            personalEducation.appendChild(degree);
            personalEducation.appendChild(gpa);

            // Append the personal-education div to the document body or a specific container
            education_container.appendChild(personalEducation);
        }

        const experience_container =  document.getElementById("conRevExperience");
        removeAllChild(experience_container);
        for (let i = 0; i < experience.length; i++){
            let ele = experience[i];
            // Create the parent div with class 'personal-experience'
            const personalExperience = document.createElement('div');
            personalExperience.className = 'personal-experience';

            // Create the vertical-line div
            const verticalLine = document.createElement('div');
            verticalLine.className = 'vertical-line';

            // Create the line div and append it to vertical-line
            const line = document.createElement('div');
            line.className = 'line';
            verticalLine.appendChild(line);

            // Create the years div and set its text content
            const years = document.createElement('div');
            years.className = 'years';
            years.textContent = '(' + ele.start_year + '-' + ele.end_year + ')';

            // Create the job div and set its text content
            const job = document.createElement('div');
            job.className = 'job';
            job.textContent = ele.job;

            // Create the company div and set its text content
            const company = document.createElement('div');
            company.className = 'company';
            company.textContent = ele.company;
            
            // Create the company div and set its text content
            const employer = document.createElement('div');
            employer.className = 'employer';
            employer.textContent = ele.employer;

            // Create the achievement ul and add list items
            const achievement = document.createElement('ul');
            achievement.className = 'achievement';

            // Create list items and append them to the achievement ul
            const achievementItems = ele.description.split(".");

            achievementItems.forEach(item => {
                if (item != ""){
                    const li = document.createElement('li');
                    li.textContent = item;
                    achievement.appendChild(li);
                }
            });

            // Append all child elements to the personal-experience div
            personalExperience.appendChild(verticalLine);
            personalExperience.appendChild(years);
            personalExperience.appendChild(job);
            personalExperience.appendChild(company);
            personalExperience.appendChild(achievement);

            // Append the personal-experience div to the document body or a specific container
            experience_container.appendChild(personalExperience);
        }
        
        if (color != ""){
            document.getElementById("conRevCV").style.setProperty("--color", color);
        }
    }
    function removeAllChild(myNode){
        while (myNode.firstChild) {
            myNode.removeChild(myNode.lastChild);
        }
    }
</script>