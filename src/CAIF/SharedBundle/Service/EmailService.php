<?php

namespace CAIF\SharedBundle\Service;

use JMS\DiExtraBundle\Annotation as DI;
use Swift_Mailer;
use Swift_Attachment;
use Symfony\Component\Templating\EngineInterface;

use CAIF\SharedBundle\Entity\Message;
use CAIF\SharedBundle\Entity\Host;
use CAIF\SharedBundle\Entity\Student;

/**
 * @DI\Service("caif.shared.email")
 */
class EmailService
{
    private $mailer;
    private $templating;

    /**
     * @DI\InjectParams({
     *      "mailer"     = @DI\Inject("mailer"),
     *      "templating" = @DI\Inject("templating")
     * })
     */
    public function __construct(Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer     = $mailer;
        $this->templating = $templating;
    }

    /**
     * Contact Us send email
     */
    public function sendContactMessage(Message $message)
    {
        $emailMessage = '<h3>From: '.$message->getName().'</h3>
                <strong>Affiliation with Clemson University: </strong>'.$message->getAffiliation().
                '<br>
                <strong>Question pertains to: </strong>'.$message->getPertains().
                '<br><br><br>'.$message->getMessage();

        /* send email */
        $this->sendEmail('CAIF Questions & Comments', ['noreply@caifclemson.org' => 'CAIF Site'], 'sccaif@gmail.com', $emailMessage, $message->getEmail());
    }

    /**
     * New Host
     */
    public function newHost(Host $host)
    {
        if ($host->getEmail() !== null) {
            /* send email to new member */
            $body = "Dear ".$host->getName().",

                Thank you for registering as host friend with Clemson Area International Friendship.  We appreciate your willingness to be involved with international students.  You will be notified via email when you have been paired with a student(s).  Further instructions will be included in that communication.

                Your participation involves committing to your student(s) for a period of at least one year if possible, making a point of contact about every month.  This can be an ice cream break, lunch, hike, email contact, dinner in your home, shopping outing, etc.  Whatever you enjoy together is fine.  The idea is for students to experience American culture in the context of friendship and family.  Other helpful tips are on our webpage at <a href='http://caifclemson.org/community-members/about'>http://caifclemson.org/community-members/about</a>.

                Should you have questions about hosting while you await to be assigned, please contact coordinator Connie Caldwell at ckcaldwell@ymail.com.

                Sincerely,

                CAIF President
                sccaif@gmail.com";

            $emailAddress = [$host->getEmail()];
            if ($host->getSecondaryEmail()) {
                $emailAddress[] = $host->getSecondaryEmail();
            }

            $this->sendEmail('Welcome to CAIF', ['noreply@caifclemson.org' => 'CAIF Site'], $emailAddress, $body, 'sccaif@gmail.com');
        }

        /* send email to kathy & alana */
        $body = '<strong>'.$host->getName().'</strong> just signed up to be a community member.

            <a href="http://caifclemson.org/profile/community-member/'.$host->getId().'/show">
                Click to view more about them
            </a>';

        $this->sendEmail('CAIF New Community Member', ['noreply@caifclemson.org' => 'CAIF Site'], ['sccaif@gmail.com', 'ckcaldwell@ymail.com'], $body);
    }

    /**
     * New student
     */
    public function newStudent(Student $student)
    {
        if ($student->getEmail() !== null) {
            /* send email to new student */
            $body = "Dear ".$student->getFirstName().",

                Thank you for registering with Clemson Area International Friendship (CAIF).  We make every effort to pair our students with an American friend or family as soon as possible.  Because this is a very popular program, sometimes our volunteer host friends are all occupied with other students, especially if registering after September.  Our waitlist is served on a first-registered, first-paired basis, so we appreciate your patience in the interim.

                You will be notified via email when the pairing process is complete.  Meanwhile, please feel free to participate in all activities offered through CAIF.  These will be listed on our webpage at <a href='http://caifclemson.org/events/all'>http://caifclemson.org/events/all</a> and on our <a href='https://www.facebook.com/groups/ClemsonAreaInternationalFriendship/'>Facebook group page</a>.  Please ask to join the group in order to stay well informed of upcoming events.

                For questions or updates about the CAIF pairing, please contact coordinator Connie Caldwell at ckcaldwell@ymail.com.

                Best wishes as you settle into our campus community!

                Sincerely,

                CAIF President
                sccaif@gmail.com";

            $this->sendEmail('Welcome to CAIF', ['noreply@caifclemson.org' => 'CAIF Site'], $student->getEmail(), $body, 'sccaif@gmail.com');
        }

        /* send email to kathy & alana */
        $body = '<strong>'.$student->getFirstName().' '.$student->getLastName().'</strong> just signed up to be apart of the program.

            <a href="http://caifclemson.org/profile/student/'.$student->getId().'/show">
                Click to view more about them
            </a>';

        $this->sendEmail('CAIF New Student', ['noreply@caifclemson.org' => 'CAIF Site'], ['sccaif@gmail.com', 'ckcaldwell@ymail.com'], $body);
    }

    /**
     * Hosting change
     * -- If host changes max number to lower than number of students they currently have
     */
    public function hostingChange(Host $host, $studentsList)
    {
        $body = '<strong>'.$host->getName().'</strong> changed their hosting status';

        if ($host->isHosting()) {
            /* still hosting, just lowered number */
            $body .= '. The maximum number of students they are willing to host is less than the number of students they were hosting.';
        } else {
            /* no longer hosting */
            $body .= ' and are no longer able to host students.';
        }

        $body .= '<br><br>The students that were dropped because of this action include:
            <p style="padding-left: 15px;">
                '.$studentsList.'
            </p>
            <a href="http://caifclemson.org/profile/community-member/'.$host->getId().'/show">
                Click here to view host
            </a>';

        $this->sendEmail('CAIF Hosting Change', ['noreply@caifclemson.org' => 'CAIF Site'], ['sccaif@gmail.com', 'ckcaldwell@ymail.com'], $body);
    }


    /**
     * Send an email
     */
    public function sendEmail($subject, $from, $to, $message, $replyTo = null, Swift_Attachment $attachment = null)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody(
                $this->templating->render('CAIFSharedBundle:Email:template.html.twig', [
                    'subject' => $subject,
                    'message' => $message,
                ]),
                'text/html'
            );

        if ($replyTo) {
            $message->setReplyTo($replyTo);
        }

        if ($attachment) {
            $message->attach($attachment);
        }

        $this->mailer->send($message);
    }

    /**
     * Send a text
     */
    private function sendText()
    {
        $text = \Swift_Message::newInstance()
            ->setFrom(['caif@caifclemson.org' => 'CAIF Site'])
            ->setTo('8642479619@txt.att.net')
            ->setBody('This is a test text');
        $this->mailer->send($text);
    }
}
