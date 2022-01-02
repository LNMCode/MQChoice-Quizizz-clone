import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:mobileapplication/components/constants.dart';
import 'package:mobileapplication/components/rounded_button.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_bloc.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_event.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_state.dart';
import 'package:mobileapplication/screens/entercode/components/entercode_container.dart';
import 'package:mobileapplication/screens/roomques/roomques_screen.dart';
import 'package:flutter/services.dart';
import 'package:mobileapplication/screens/waitroom/waitroom_screen.dart';

class EnterCodeScreen extends StatefulWidget {
  const EnterCodeScreen({
    Key? key,
  }) : super(key: key);

  @override
  State<StatefulWidget> createState() => _EnterCodeScreenState();
}

class _EnterCodeScreenState extends State<EnterCodeScreen> {
  var _textEnterCode;
  var _textNameUser;
  final String iduser = DateTime.now().microsecondsSinceEpoch.toString();

  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    // Full screen
    SystemChrome.setEnabledSystemUIMode(SystemUiMode.immersive);
    Size size = MediaQuery.of(context).size;
    return Scaffold(
      resizeToAvoidBottomInset: false,
      appBar: AppBar(
        backgroundColor: Colors.white,
        elevation: 0,
        title: SvgPicture.asset(
          'assets/icons/logo.svg',
          width: size.width * 0.4,
        ),
        bottom: PreferredSize(
          child: Container(
            color: borderColor,
            height: 1.0,
          ),
          preferredSize: Size.fromHeight(4.0),
        ),
      ),
      body: BlocConsumer<EnterCodeBloc, EnterCodeState>(
        listener: (context, state) {
          if (state is EnterCodeStateSuccess) {
            if (state.enterCodeResponse.isgo) {
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(builder: (context) {
                  return WaitRoomScreen(
                    iduser: iduser,
                    idroom: _textEnterCode,
                    nameuser: _textNameUser,
                  );
                }),
              );
            }
          }
        },
        builder: (context, state) {
          return Container(
            child: Column(children: <Widget>[
              EnterCodeContainer(
                onChangeEnterCode: (value) {
                  _textEnterCode = value;
                },
                onChangeUserName: (value) {
                  _textNameUser = value;
                },
                onPress: () {
                  if (_textEnterCode != null && _textNameUser != null) {
                    BlocProvider.of<EnterCodeBloc>(context).add(
                        EnterCodeSumitted(_textEnterCode.toString().trim()));
                  }
                },
              ),
            ]),
          );
        },
      ),
    );
  }
}
